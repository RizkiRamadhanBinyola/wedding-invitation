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
        $indexBlade = <<<BLADE
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Undangan Pernikahan</title>
    <link rel="stylesheet" href="{{ asset('assets/{$slug}/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Undangan Pernikahan</h1>

        <p><strong>Pria:</strong> {{ \$data['nama_pria'] }}</p>
        <p><strong>Wanita:</strong> {{ \$data['nama_wanita'] }}</p>
        <p><strong>Tanggal Acara:</strong> {{ \$data['tanggal'] }}</p>
        <p><strong>Lokasi:</strong> {{ \$data['lokasi'] }}</p>

        <hr>
        <p><strong>Ucapan:</strong> {{ \$data['ucapan'] }}</p>

        @if(\$isDummy)
            <p style="color:red;">[Mode Preview Dummy]</p>
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
