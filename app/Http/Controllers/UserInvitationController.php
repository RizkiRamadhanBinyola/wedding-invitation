<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Invitation;
use App\Models\Theme;

class UserInvitationController extends Controller
{
    /* ----------------------------  LIST  ---------------------------- */
    public function index()
{
    $user = Auth::user();          // ambil user yang sedang login

    $invitations = $user->isAdmin()
        ? Invitation::with('theme', 'user')->latest()->paginate(20)   // admin → semua data
        : Invitation::where('user_id', $user->id)
                     ->with('theme')
                     ->latest()
                     ->paginate(20);                                 // user  → miliknya

    // 👉 Jika admin memiliki tampilan tabel berbeda, ganti path view di sini
    //    misalnya: $view = $user->isAdmin() ? 'admin.invitations.index' : 'user.invitations.index';
    //    return view($view, compact('invitations'));

    return view('user.invitations.index', compact('invitations'));
}

    /* ---------------------------  CREATE  --------------------------- */
    public function create()
    {
        $themes = Theme::all();
        return view('user.invitations.create', compact('themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme_id'        => 'required|exists:themes,id',
            'nama_pria'       => 'required',
            'nama_wanita'     => 'required',
            'ortu_pria'       => 'required',
            'ortu_wanita'     => 'required',
            'anak_ke'         => 'required',
            'tanggal'         => 'required|date',
            'lokasi'          => 'required',
            'no_telp'         => 'required',
            'email'           => 'required|email',
            'waktu_akad'      => 'required',
            'waktu_resepsi'   => 'required',
        ]);

        /* ----- Generate slug unik & tidak pakai kata “terlarang” ----- */
        $forbidden = [
            'dashboard','profile','themes','invitations',
            'login','register','logout','password','email',
            'api','sanctum',
        ];

        do {
            $slug = Str::slug("{$request->nama_pria}-{$request->nama_wanita}")
                  . '-' . Str::random(6);
        } while (in_array($slug, $forbidden) || Invitation::where('slug', $slug)->exists());

        /* ----------------------- Buat Record ------------------------ */
        Invitation::create([
            'user_id'         => Auth::id(),
            'theme_id'        => $request->theme_id,
            'slug'            => $slug,

            'nama_pria'       => $request->nama_pria,
            'nama_wanita'     => $request->nama_wanita,
            'ortu_pria'       => $request->ortu_pria,
            'ortu_wanita'     => $request->ortu_wanita,
            'anak_ke'         => $request->anak_ke,
            'tanggal'         => $request->tanggal,
            'lokasi'          => $request->lokasi,
            'no_telp'         => $request->no_telp,
            'email'           => $request->email,
            'waktu_akad'      => $request->waktu_akad,
            'waktu_resepsi'   => $request->waktu_resepsi,
            'no_rekening'     => $request->no_rekening,
            'instagram'       => $request->instagram,
            'musik'           => $request->musik,
        ]);

        return redirect()
            ->route('invitations.index')
            ->with('success', 'Undangan berhasil dibuat.');
    }

    /* ----------------------------  EDIT  --------------------------- */
    public function edit(Invitation $invitation)
    {
        abort_unless($invitation->user_id == Auth::id(), 403);

        $themes = Theme::all();
        return view('user.invitations.edit', compact('invitation', 'themes'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        abort_unless($invitation->user_id == Auth::id(), 403);

        $request->validate([
            'theme_id'        => 'required|exists:themes,id',
            'nama_pria'       => 'required',
            'nama_wanita'     => 'required',
            'ortu_pria'       => 'required',
            'ortu_wanita'     => 'required',
            'anak_ke'         => 'required',
            'tanggal'         => 'required|date',
            'lokasi'          => 'required',
            'no_telp'         => 'required',
            'email'           => 'required|email',
            'waktu_akad'      => 'required',
            'waktu_resepsi'   => 'required',
        ]);

        $invitation->update($request->all());

        return redirect()
            ->route('invitations.index')
            ->with('success', 'Undangan berhasil diperbarui.');
    }

    /* ---------------------------  DELETE  -------------------------- */
    public function destroy(Invitation $invitation)
    {
        abort_unless($invitation->user_id == Auth::id(), 403);

        $invitation->delete();

        return redirect()
            ->route('invitations.index')
            ->with('success', 'Undangan berhasil dihapus.');
    }
}
