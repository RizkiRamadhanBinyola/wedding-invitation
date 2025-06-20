<?php

namespace App\Http\Controllers;

use App\Models\Invitation;

class InvitationController extends Controller
{
    /** Menampilkan undangan publik berdasarkan slug */
    public function show(string $slug)
    {
        // 1. Ambil undangan + relasi tema & ucapan
        $invitation = Invitation::with(['theme','greetings'])
                     ->where('slug', $slug)->firstOrFail();

        // 2. Tema slug
        $themeSlug = optional($invitation->theme)->slug ?? 'default';

        // 3. Susun $data (kompatibel dengan template lama)
        $data = $invitation->only([
            'nama_pria', 'nama_wanita',
            'ortu_pria', 'ortu_wanita',
            'anak_ke',   'tanggal',
            'lokasi',    'no_telp',
            'email',     'waktu_akad',
            'waktu_resepsi', 'no_rekening',
            'instagram', 'musik',
        ]);
        $data['greetings'] = $invitation->greetings; // agar bisa dipakai di template baru

        // 4. Render view tema
        return view("admin.themes.$themeSlug.index", [
            'invitation' => $invitation, // dipakai template baru
            'data'       => $data,       // dipakai template lama
            'isDummy'    => false,
        ]);
    }
}
