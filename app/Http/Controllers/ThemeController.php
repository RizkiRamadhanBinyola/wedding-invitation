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
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:themes,slug',
            'preview' => 'nullable|image|max:2048',
        ]);

        $slug = $request->slug;
        $previewPath = null;

        // ===== Buat folder asset public/assets/<slug> =====
        $assetFolder = public_path("assets/{$slug}");
        if (!File::exists($assetFolder)) {
            File::makeDirectory($assetFolder, 0755, true);
        }

        // ===== Simpan preview ke public/assets/<slug>/preview.ext =====
        if ($request->hasFile('preview')) {
            $file = $request->file('preview');
            $fileName = 'preview.' . $file->getClientOriginalExtension();
            $destination = $assetFolder . '/' . $fileName;

            $file->move($assetFolder, $fileName);
            $previewPath = "assets/{$slug}/{$fileName}";
        }

        // ===== Simpan ke database =====
        Theme::create([
            'name' => $request->name,
            'slug' => $slug,
            'preview' => $previewPath,
        ]);

        // ===== Buat folder view tema di resources/views/admin/themes/<slug> =====
        $viewPath = resource_path("views/admin/themes/{$slug}");
        if (!File::exists($viewPath)) {
            File::makeDirectory($viewPath, 0755, true);
        }

        // ===== Buat index.blade.php dengan struktur HTML dan link CSS/JS =====
// ThemeController@store()
$indexBlade = <<<'BLADE'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Undangan Pernikahan</title>
    <link rel="stylesheet" href="{{ asset('assets/{$slug}/style.css') }}">
    <style>
        body {font-family: Arial, sans-serif; line-height:1.5;}
        .container {max-width:640px;margin:auto;padding:2rem;}
        input,textarea {width:100%;padding:.5rem;margin-top:.25rem;border:1px solid #ccc;border-radius:4px;}
        button {padding:.5rem 1rem;background:#2563eb;color:#fff;border:none;border-radius:4px;cursor:pointer;}
        button:hover {background:#1e40af;}
    </style>
</head>
<body>
<div class="container">
    <h1 style="text-align:center;margin-bottom:1.5rem;">Undangan Pernikahan</h1>

    {{-- ======= DATA INTI ======= --}}
    <p><strong>Pria:</strong> {{ $invitation->nama_pria ?? $data['nama_pria'] ?? '' }}</p>
    <p><strong>Wanita:</strong> {{ $invitation->nama_wanita ?? $data['nama_wanita'] ?? '' }}</p>
    <p><strong>Tanggal:</strong>
        {{ \Carbon\Carbon::parse($invitation->tanggal ?? $data['tanggal'])->format('d M Y') }}</p>
    <p><strong>Lokasi:</strong> {{ $invitation->lokasi ?? $data['lokasi'] ?? '' }}</p>

    <hr style="margin:2rem 0">

    {{-- ======= FORM UCAPAN ======= --}}
    @if(!$isDummy)
    <h2>Kirim Ucapan &amp; Doa</h2>
    @if(session('success'))
        <div style="color:green;margin-bottom:1rem;">{{ session('success') }}</div>
    @endif

    <form action="{{ url()->current() }}/greetings" method="POST" style="margin-bottom:2rem;">
        @csrf
        <label>Nama Anda
            <input type="text" name="nama_pengirim" required>
        </label>
        <label>Ucapan
            <textarea name="isi_ucapan" rows="3" required></textarea>
        </label>
        <button type="submit">Kirim Ucapan</button>
    </form>
    @endif

    {{-- ======= LIST UCAPAN ======= --}}
    <h2>Ucapan Tamu</h2>
    @php($greetList = $invitation->greetings ?? ($data['greetings'] ?? collect()))
    @if($greetList->count())
        @foreach($greetList as $greet)
            <div style="margin-bottom:1rem;border-bottom:1px dashed #ddd;padding-bottom:.5rem;">
                <strong>{{ $greet->nama_pengirim }}</strong><br>
                {{ $greet->isi_ucapan }}
            </div>
        @endforeach
    @else
        <p>Belum ada ucapan.</p>
    @endif

    @if($isDummy)
        <p style="color:red;margin-top:2rem;">[Mode Preview Dummy]</p>
    @endif
</div>

<script src="{{ asset('assets/{$slug}/script.js') }}"></script>
</body>
</html>
BLADE;


        File::put("{$viewPath}/index.blade.php", $indexBlade);

        // ===== Buat file style.css dan script.js kosong =====
        File::put("{$assetFolder}/style.css", "/* Gaya CSS untuk tema {$slug} */");
        File::put("{$assetFolder}/script.js", "// Script JS untuk tema {$slug}");

        return redirect()->route('themes.index')->with('success', 'Tema berhasil ditambahkan');
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
