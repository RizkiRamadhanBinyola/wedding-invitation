<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return view('admin.themes.index', compact('themes'));
    }

    public function create()
    {
        return view('admin.themes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'slug'    => 'required|alpha_dash|unique:themes,slug',
            'preview' => 'nullable|image|max:2048',
        ]);

        /* ------------------------------------------------- */
        /* 1.  Persiapan folder                             */
        /* ------------------------------------------------- */
        $slug        = $request->slug;
        $assetFolder = public_path("assets/{$slug}");
        $viewFolder  = resource_path("views/admin/themes/{$slug}");
        $sectionDir  = "{$viewFolder}/sections";

        foreach ([$assetFolder, $viewFolder, $sectionDir] as $dir) {
            if (! file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
        }

        /* ------------------------------------------------- */
        /* 2.  Upload preview (opsional)                     */
        /* ------------------------------------------------- */
        $previewPath = null;
        if ($request->hasFile('preview')) {
            $filename    = 'preview.' . $request->file('preview')->getClientOriginalExtension();
            $request->file('preview')->move($assetFolder, $filename);
            $previewPath = "assets/{$slug}/{$filename}";
        }

        /* ------------------------------------------------- */
        /* 3.  Simpan DB                                     */
        /* ------------------------------------------------- */
        Theme::create([
            'name'    => $request->name,
            'slug'    => $slug,
            'preview' => $previewPath,
        ]);

        /* ------------------------------------------------- */
        /* 4.  Generate index.blade.php                      */
        /* ------------------------------------------------- */
        $indexBlade = <<<BLADE
@extends('layouts.blank')

@php(\$slug = '$slug') {{-- agar bisa dipakai includeIf --}}

@section('content')
@includeIf("admin.themes.\$slug.sections.hero",   get_defined_vars())
@includeIf("admin.themes.\$slug.sections.couple", get_defined_vars())
@includeIf("admin.themes.\$slug.sections.event",  get_defined_vars())
@endsection
BLADE;

        file_put_contents("{$viewFolder}/index.blade.php", $indexBlade);

        /* ------------------------------------------------- */
        /* 5.  Generate section partials (dummy)             */
        /* ------------------------------------------------- */
        file_put_contents("{$sectionDir}/hero.blade.php",   <<<BLADE
<section class="text-center my-12">
    <h1 class="text-4xl font-bold">{{ \$invitation->nama_pria ?? '-' }} &amp; {{ \$invitation->nama_wanita ?? '-' }}</h1>
    <p class="mt-2 text-lg text-gray-600">
        {{ optional(\$invitation->tanggal ?? null)->format('d M Y') }}
    </p>
</section>
BLADE);

        file_put_contents("{$sectionDir}/couple.blade.php", <<<BLADE
<section class="my-12">
    <h2 class="text-2xl font-semibold mb-4">Tentang Kami</h2>
    <p>Deskripsikan kisah singkat pasangan di sini…</p>
</section>
BLADE);

        file_put_contents("{$sectionDir}/event.blade.php",  <<<BLADE
<section class="my-12">
    <h2 class="text-2xl font-semibold mb-4">Detail Acara</h2>
    <ul class="list-disc pl-5 space-y-1">
        <li><strong>Akad :</strong> {{ \$invitation->waktu_akad ?? '-' }}</li>
        <li><strong>Resepsi :</strong> {{ \$invitation->waktu_resepsi ?? '-' }}</li>
        <li><strong>Lokasi :</strong> {{ \$invitation->lokasi ?? '-' }}</li>
    </ul>
</section>
BLADE);

// Tambahan untuk membuat greetings.blade.php secara otomatis
file_put_contents("{$sectionDir}/greetings.blade.php", <<<BLADE
<section class="my-12 max-w-xl mx-auto px-4">
    <h2 class="text-2xl font-semibold mb-4 text-center">Ucapan & Doa</h2>

    {{-- Daftar ucapan --}}
    @if(\$invitation->greetings->isEmpty())
        <p class="text-center text-gray-500">Belum ada ucapan.</p>
    @else
        <div class="space-y-4">
            @foreach(\$invitation->greetings as \$greeting)
                <div class="border p-4 rounded bg-gray-100 shadow">
                    <p class="font-semibold text-pink-700">{{ \$greeting->nama_pengirim }}</p>
                    <p class="text-gray-700">{{ \$greeting->isi_ucapan }}</p>
                    <p class="text-xs text-gray-500">{{ \$greeting->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Form ucapan --}}
    <form method="POST" action="{{ route('greetings.public', \$invitation->slug) }}" class="mt-8 space-y-4">
        @csrf
        <input type="text" name="nama_pengirim" placeholder="Nama Anda" required
            class="w-full border border-gray-300 p-2 rounded focus:outline-pink-500">
        
        <textarea name="isi_ucapan" rows="4" placeholder="Tulis ucapan dan doa..." required
            class="w-full border border-gray-300 p-2 rounded focus:outline-pink-500"></textarea>
        
        <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 w-full">
            Kirim Ucapan
        </button>
    </form>

    @if(session('success'))
        <div class="mt-4 text-green-600 text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif
</section>
BLADE);

        /* ------------------------------------------------- */
        /* 6.  Asset kosong                                  */
        /* ------------------------------------------------- */
        file_put_contents("{$assetFolder}/style.css",  "/* CSS {$slug} */");
        file_put_contents("{$assetFolder}/script.js", "// JS {$slug}");

        /* ------------------------------------------------- */
        return redirect()->route('themes.index')
            ->with('success', 'Tema berhasil ditambahkan');
    }




    public function edit(Theme $theme)
    {
        return view('admin.themes.edit', compact('theme'));
    }

    public function update(Request $request, Theme $theme)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:themes,slug,' . $theme->id,
            'preview' => 'nullable|image|max:2048',
        ]);

        $slug = $theme->slug; // kita gunakan slug lama untuk path

        // Jika ada file preview baru, hapus yang lama dan simpan yang baru
        if ($request->hasFile('preview')) {
            $assetFolder = public_path("assets/{$slug}");

            // Hapus file preview lama
            if ($theme->preview && file_exists(public_path($theme->preview))) {
                unlink(public_path($theme->preview));
            }

            // Simpan preview baru di path yang sama
            $file = $request->file('preview');
            $fileName = 'preview.' . $file->getClientOriginalExtension();
            $file->move($assetFolder, $fileName);

            // Perbarui path preview di database
            $theme->preview = "assets/{$slug}/{$fileName}";
        }

        // Update nama tema
        $theme->update([
            'name' => $request->name,
            'preview' => $theme->preview, // sudah diperbarui jika ada file baru
        ]);

        return redirect()->route('themes.index')->with('success', 'Tema berhasil diupdate');
    }


    public function destroy(Theme $theme)
    {
        $slug = $theme->slug;

        // Hapus dari database
        $theme->delete();

        // Hapus folder view
        $viewPath = resource_path("views/admin/themes/{$slug}");
        if (File::exists($viewPath)) {
            File::deleteDirectory($viewPath);
        }

        // Hapus folder public asset: public/assets/<slug>
        $publicAssetPath = public_path("assets/{$slug}");
        if (File::exists($publicAssetPath)) {
            File::deleteDirectory($publicAssetPath);
        }

        return redirect()->route('themes.index')->with('success', 'Tema berhasil dihapus');
    }
}
