<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Midtrans\Config;

class InvitationController extends Controller
{
    /**
     * Menampilkan undangan publik berdasarkan slug
     */
    public function show(string $slug)
    {
        $invitation = Invitation::with(['theme', 'greetings'])
            ->where('slug', $slug)->firstOrFail();

        $themeSlug = optional($invitation->theme)->slug ?? 'default';

        $data = $invitation->only([
            'nama_pria',
            'nama_wanita',
            'ortu_pria',
            'ortu_wanita',
            'anak_ke',
            'tanggal',
            'lokasi',
            'no_telp',
            'email',
            'waktu_akad',
            'waktu_resepsi',
            'no_rekening',
            'instagram',
            'musik',
        ]);
        $data['greetings'] = $invitation->greetings;

        return view("admin.themes.$themeSlug.index", [
            'invitation' => $invitation,
            'data'       => $data,
            'isDummy'    => false,
            'slug'       => $themeSlug,
        ]);
    }

    /**
     * Menampilkan form setup undangan pertama kali
     */
    public function showSetupForm()
    {
        $user = Auth::user();

        if ($user->invitations()->exists()) {
            return redirect()->route('dashboard')->with('info', 'Undangan sudah pernah dibuat.');
        }

        $themes = Theme::all();
        $packages = Package::all();

        return view('user.setup-invitation', compact('themes', 'packages'));
    }

    /**
     * Proses form setup undangan
     */
    public function submitSetupForm(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:invitations,slug',
            'judul' => 'required',
            'package_id' => 'required|exists:packages,id',
            'theme_id' => 'required|exists:themes,id',
        ]);

        $user = auth()->user();
        $package = Package::findOrFail($request->package_id);

        // Simpan undangan
        $invitation = Invitation::create([
            'user_id'     => $user->id,
            'slug'        => $request->slug,
            'nama_pria'   => $request->judul,
            'theme_id'    => $request->theme_id,
            'package_id'  => $package->id,
            'status'      => Invitation::STATUS_DRAFT,
        ]);

        // Jika paket gratis, langsung arahkan ke kelola
        if ($package->price <= 0) {
            return redirect()->route('invitations.kelola', $invitation->id)
                ->with('success', 'Undangan berhasil dibuat!');
        }

        // Paket berbayar -> simpan transaksi
        $orderId = 'INV-' . strtoupper(Str::random(10));

        $transaction = Transaction::create([
            'user_id'           => $user->id,
            'invitation_id'     => $invitation->id,
            'order_id'          => $orderId,
            'gross_amount'      => $package->price,
            'transaction_status'=> 'pending',
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized  = config('midtrans.isSanitized');
        Config::$is3ds        = config('midtrans.is3ds');

        // Parameter Midtrans Snap
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $package->price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
            'callbacks' => [
                'finish' => route('payment.callback'),
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.redirect', compact('snapToken'));
    }
}
