<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InvitationController extends Controller
{
    /**
     * Menampilkan undangan publik berdasarkan slug
     */
    public function show(string $slug)
    {
        $invitation = Invitation::with(['theme', 'greetings'])
            ->where('slug', $slug)->firstOrFail();

        $themeSlug = optional($invitation->theme)->slug ?? 'default';

        $data = $invitation->only([
            'nama_pria',
            'nama_wanita',
            'ortu_pria',
            'ortu_wanita',
            'anak_ke',
            'tanggal',
            'lokasi',
            'no_telp',
            'email',
            'waktu_akad',
            'waktu_resepsi',
            'no_rekening',
            'instagram',
            'musik',
        ]);
        $data['greetings'] = $invitation->greetings;

        return view("admin.themes.$themeSlug.index", [
            'invitation' => $invitation,
            'data'       => $data,
            'isDummy'    => false,
            'slug'       => $themeSlug,
        ]);
    }

    /**
     * Menampilkan form setup undangan pertama kali
     */
    public function showSetupForm()
    {
        $user = Auth::user();

        // Jika user sudah punya undangan, redirect
        if ($user->invitations()->exists()) {
            return redirect()->route('dashboard')->with('info', 'Undangan sudah pernah dibuat.');
        }

        // Tampilkan semua tema, frontend akan filter berdasarkan paket
        $themes = Theme::all();
        return view('user.setup-invitation', compact('themes'));
    }

    /**
     * Proses form setup undangan
     */
    public function submitSetupForm(Request $request)
    {
        $request->validate([
            'slug'     => 'required|unique:invitations,slug',
            'judul'    => 'required|string|max:255',
            'paket'    => 'required|in:gratis,premium,gold,silver',
            'theme_id' => 'required|exists:themes,id',
        ]);

        $user = Auth::user();

        // Cek apakah sudah pernah setup
        if ($user->invitations()->exists()) {
            return redirect()->route('dashboard')->with('info', 'Setup undangan hanya bisa dilakukan satu kali.');
        }

        // Validasi tema sesuai paket
        $theme = Theme::findOrFail($request->theme_id);
        $isGratis = $request->paket === 'gratis';

        if ($isGratis && $theme->kategori !== 'gratis') {
            return back()->withErrors(['theme_id' => 'Paket gratis hanya dapat memilih tema gratis.'])->withInput();
        }

        // Buat undangan baru
        Invitation::create([
            'user_id'        => $user->id,
            'theme_id'       => $theme->id,
            'slug'           => $request->slug,
            'nama_pria'      => $request->judul, // ganti sesuai kebutuhan
            'nama_wanita'    => '',
            'ortu_pria'      => '',
            'ortu_wanita'    => '',
            'anak_ke'        => '',
            'tanggal'        => now(),
            'lokasi'         => '',
            'no_telp'        => '',
            'email'          => $user->email,
            'waktu_akad'     => '',
            'waktu_resepsi'  => '',
            'no_rekening'    => null,
            'instagram'      => null,
            'musik'          => null,
            'status'         => 'draft',
        ]);

        return redirect()->route('dashboard')->with('success', 'Undangan berhasil dibuat.');
    }
}
