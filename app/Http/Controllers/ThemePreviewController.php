<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemePreviewController extends Controller
{
    // Untuk admin: pakai data dummy
    public function previewDummy($slug)
    {
        $theme = Theme::where('slug', $slug)->firstOrFail();

        $data = [
            'nama_pria' => 'Raka Aditya',
            'nama_wanita' => 'Salsabila Anjani',
            'tanggal' => '2025-08-17',
            'lokasi' => 'Hotel Grand Merdeka, Jakarta',
            'ucapan' => 'Selamat menempuh hidup baru!',
        ];

        return view("admin.themes.{$slug}.index", ['data' => $data, 'isDummy' => true]);
    }

    // Untuk user: data diambil dari database undangan (contoh dummy saja)
    public function previewUser($slug)
    {
        $theme = Theme::where('slug', $slug)->firstOrFail();

        // Ini seharusnya ambil dari tabel undangan user, contoh hardcoded
        $data = [
            'nama_pria' => 'Dimas Pratama',
            'nama_wanita' => 'Nadya Putri',
            'tanggal' => '2025-12-24',
            'lokasi' => 'The Dharmawangsa, Jakarta Selatan',
            'ucapan' => 'Semoga menjadi keluarga yang sakinah mawaddah warahmah.',
        ];

        return view("admin.themes.{$slug}.index", ['data' => $data, 'isDummy' => false]);
    }
}
