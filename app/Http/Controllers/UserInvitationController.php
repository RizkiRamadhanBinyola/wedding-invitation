<?php
// app/Http/Controllers/UserInvitationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Theme;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserInvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::where('user_id', Auth::id())->get();
        return view('user.invitations.index', compact('invitations'));
    }

    public function create()
    {
        $themes = Theme::all();
        return view('user.invitations.create', compact('themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme_id' => 'required|exists:themes,id',
            'nama_pria' => 'required',
            'nama_wanita' => 'required',
            'ortu_pria' => 'required',
            'ortu_wanita' => 'required',
            'anak_ke' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'waktu_akad' => 'required',
            'waktu_resepsi' => 'required',
        ]);

        $invitation = Invitation::create([
            'user_id' => Auth::id(),
            'theme_id' => $request->theme_id,
            'slug' => Str::slug($request->nama_pria . '-' . $request->nama_wanita . '-' . uniqid()),

            'nama_pria' => $request->nama_pria,
            'nama_wanita' => $request->nama_wanita,
            'ortu_pria' => $request->ortu_pria,
            'ortu_wanita' => $request->ortu_wanita,
            'anak_ke' => $request->anak_ke,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'waktu_akad' => $request->waktu_akad,
            'waktu_resepsi' => $request->waktu_resepsi,
            'no_rekening' => $request->no_rekening,
            'instagram' => $request->instagram,
            'musik' => $request->musik,
        ]);

        return redirect()->route('user.invitations.index')->with('success', 'Undangan berhasil dibuat.');
    }

    public function edit(Invitation $invitation)
    {
        if ($invitation->user_id != Auth::id()) abort(403);
        $themes = Theme::all();
        return view('user.invitations.edit', compact('invitation', 'themes'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        if ($invitation->user_id != Auth::id()) abort(403);

        $request->validate([
            'theme_id' => 'required|exists:themes,id',
            'nama_pria' => 'required',
            'nama_wanita' => 'required',
            'ortu_pria' => 'required',
            'ortu_wanita' => 'required',
            'anak_ke' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'waktu_akad' => 'required',
            'waktu_resepsi' => 'required',
        ]);

        $invitation->update($request->all());

        return redirect()->route('user.invitations.index')->with('success', 'Undangan berhasil diperbarui.');
    }

    public function destroy(Invitation $invitation)
    {
        if ($invitation->user_id != Auth::id()) abort(403);

        $invitation->delete();

        return redirect()->route('user.invitations.index')->with('success', 'Undangan berhasil dihapus.');
    }
}