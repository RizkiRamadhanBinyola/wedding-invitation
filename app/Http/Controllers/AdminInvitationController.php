<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminInvitationController extends Controller
{
    /* ─────────────────── INDEX ─────────────────── */
    public function index()
    {
        $invitations = Invitation::with(['theme','user'])
                         ->latest()->paginate(20);

        return view('admin.invitations.index', compact('invitations'));
    }

    /* ─────────────────── CREATE ────────────────── */
    public function create()
    {
        return view('admin.invitations.create', [
            'themes' => Theme::all(),
            'users'  => User::all(),
        ]);
    }

    /* ─────────────────── STORE ─────────────────── */
    public function store(Request $r)
    {
        $data = $this->validated($r);

        // buat slug unik otomatis
        $data['slug'] = Str::slug($data['nama_pria'].'-'.$data['nama_wanita'].'-'.Str::random(4));

        Invitation::create($data);

        return to_route('admin.invitations.index')
               ->with('success','Undangan berhasil dibuat');
    }

    /* ─────────────────── EDIT ──────────────────── */
    public function edit(Invitation $invitation)
    {
        return view('admin.invitations.edit', [
            'invitation' => $invitation,
            'themes'     => Theme::all(),
            'users'      => User::all(),
        ]);
    }

    /* ─────────────────── UPDATE ────────────────── */
    public function update(Request $r, Invitation $invitation)
    {
        $data = $this->validated($r, $invitation->id);

        $invitation->update($data);

        return back()->with('success','Undangan diperbarui');
    }

    /* ────────────────── DESTROY ────────────────── */
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return back()->with('success','Undangan dihapus');
    }

    /* ─────────────── Helper: Validation ────────── */
    private function validated(Request $r, ?int $id = null): array
    {
        return $r->validate([
            'user_id'        => ['required','exists:users,id'],
            'theme_id'       => ['required','exists:themes,id'],
            'nama_pria'      => ['required','string'],
            'nama_wanita'    => ['required','string'],
            'ortu_pria'      => ['required','string'],
            'ortu_wanita'    => ['required','string'],
            'anak_ke'        => ['required','string'],
            'tanggal'        => ['required','date'],
            'lokasi'         => ['required','string'],
            'no_telp'        => ['required','string'],
            'email'          => ['required','email'],
            'waktu_akad'     => ['required','string'],
            'waktu_resepsi'  => ['required','string'],
            'no_rekening'    => ['nullable','string'],
            'instagram'      => ['nullable','string'],
            'musik'          => ['nullable','string'],
            // slug tidak di‑input manual oleh admin
        ]);
    }
}
