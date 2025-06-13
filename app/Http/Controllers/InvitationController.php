<?php

namespace App\Http\Controllers;

use App\Models\Invitation;

class InvitationController extends Controller
{
    /**
     * Menampilkan undangan publik berdasarkan slug.
     * URL: https://domain.com/{slug}
     */
    public function show(string $slug)
    {
        // Ambil undangan plus relasi theme
        $invitation = Invitation::with('theme')
            ->where('slug', $slug)
            ->firstOrFail();

        // Gunakan slug tema, fallback ke 'default' jika null
        $themeSlug = optional($invitation->theme)->slug ?? 'default';

        // Jika kamu ingin memecah data satu‑satu:
        $data = $invitation->only([
            'nama_pria', 'nama_wanita',
            'ortu_pria', 'ortu_wanita',
            'anak_ke',  'tanggal',
            'lokasi',   'no_telp',
            'email',    'waktu_akad',
            'waktu_resepsi', 'no_rekening',
            'instagram', 'musik',
        ]);

        // Render view tema.
        // Bila masih disimpan di /resources/views/admin/themes/<tema>/index.blade.php
        return view("admin.themes.$themeSlug.index", [
            'data'    => $data,
            'isDummy' => false,
        ]);
    }
}
