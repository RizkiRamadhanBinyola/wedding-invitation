<?php

// app/Http/Controllers/InvitationController.php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show($slug)
    {
        $invitation = Invitation::where('slug', $slug)->with('theme')->firstOrFail();

        $data = [
            'nama_pria' => $invitation->nama_pria,
            'nama_wanita' => $invitation->nama_wanita,
            'ortu_wanita' => $invitation->ortu_wanita,
            'ortu_pria' => $invitation->ortu_pria,
            'anak_ke' => $invitation->anak_ke,
            'tanggal' => $invitation->tanggal,
            'lokasi' => $invitation->lokasi,
            'no_telp' => $invitation->no_telp,
            'email' => $invitation->email,
            'waktu_akad' => $invitation->waktu_akad,
            'waktu_resepsi' => $invitation->waktu_resepsi,
            'no_rekening' => $invitation->no_rekening,
            'instagram' => $invitation->instagram,
            'musik' => $invitation->musik,
        ];

        return view("admin.themes.{$invitation->theme->slug}.index", [
            'data' => $data,
            'isDummy' => false,
        ]);
    }
}