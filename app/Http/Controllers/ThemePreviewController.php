<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemePreviewController extends Controller
{
    /* ───────────────────  PREVIEW DUMMY untuk ADMIN  ─────────────────── */
    public function previewDummy(string $slug)
    {
        $theme = Theme::where('slug', $slug)->firstOrFail();

        $data = [
            'nama_pria'   => 'Raka Aditya',
            'nama_wanita' => 'Salsabila Anjani',
            'tanggal'     => '2025-08-17',
            'lokasi'      => 'Hotel Grand Merdeka, Jakarta',
            'ucapan'      => 'Selamat menempuh hidup baru!',
        ];

        return view("admin.themes.{$slug}.index", [
            'data'    => $data,
            'isDummy' => true,
            'slug'    => $slug,   // ★ NEW
        ]);
    }

    /* ───────────────────  PREVIEW MILIK USER (login)  ─────────────────── */
    public function previewUser(string $slug)
    {
        $theme = Theme::where('slug', $slug)->firstOrFail();

        // seharusnya mengambil data asli dari tabel invitations …
        $data = [
            'nama_pria'   => 'Dimas Pratama',
            'nama_wanita' => 'Nadya Putri',
            'tanggal'     => '2025-12-24',
            'lokasi'      => 'The Dharmawangsa, Jakarta Selatan',
            'ucapan'      => 'Semoga menjadi keluarga yang sakinah mawaddah warahmah.',
        ];

        return view("admin.themes.{$slug}.index", [
            'data'    => $data,
            'isDummy' => false,
            'slug'    => $slug,   // ★ NEW
        ]);
    }
}
