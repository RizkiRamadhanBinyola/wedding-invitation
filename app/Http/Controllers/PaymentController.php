<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Notification;
use App\Models\Transaction;
use App\Models\Invitation;

class PaymentController extends Controller
{
    public function handle(Request $request)
    {
        $notif = new Notification();

        $transaction = Transaction::where('order_id', $notif->order_id)->first();

        if (!$transaction) return response()->json(['message' => 'Transaction not found'], 404);

        // Simpan semua response midtrans ke kolom 'response' (optional untuk debugging)
        $transaction->update(['response' => json_encode($notif)]);

        $status = $notif->transaction_status;

        if ($status === 'settlement' || $status === 'capture') {
            $transaction->transaction_status = 'paid';

            // Update status undangan menjadi "draft" atau "published"
            Invitation::where('user_id', $transaction->user_id)
                ->where('id', $transaction->invitation_id)
                ->update(['status' => 'draft']);

        } elseif ($status === 'pending') {
            $transaction->transaction_status = 'pending';
        } elseif ($status === 'cancel' || $status === 'expire' || $status === 'deny') {
            $transaction->transaction_status = 'failed';
        }

        $transaction->save();

        return response()->json(['message' => 'Callback handled']);
    }
}
