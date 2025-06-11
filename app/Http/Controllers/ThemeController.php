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

            // Simpan path relatif dari folder public ke DB
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

        // Salin file template.blade.php ke folder tema
        $templateSource = resource_path("views/admin/themes/template.blade.php");
        $templateDestination = "{$viewPath}/index.blade.php";
        if (File::exists($templateSource)) {
            File::copy($templateSource, $templateDestination);
        }

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

        if ($request->hasFile('preview')) {
            $previewPath = $request->file('preview')->store('themes/previews', 'public');
            $theme->preview = $previewPath;
        }

        $theme->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'preview' => $theme->preview,
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
