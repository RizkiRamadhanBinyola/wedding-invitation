<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Greeting;
use Illuminate\Http\Request;

class GreetingController extends Controller
{
    /** Form publik: kirim ucapan di halaman undangan */
    public function storePublic(Request $r, string $slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        $data = $r->validate([
            'nama_pengirim' => 'required|string|max:255',
            'isi_ucapan'    => 'required|string',
        ]);

        $invitation->greetings()->create($data);

        return back()->with('success', 'Ucapan berhasil dikirim!');
    }
}
