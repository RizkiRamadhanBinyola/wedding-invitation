<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UnifiedInvitationController extends Controller
{
    /* ───────────────────────── INDEX ───────────────────────── */
    public function index()
    {
        $query = Invitation::with(['theme', 'user'])->latest();

        // User biasa hanya melihat miliknya
        if (Auth::user()?->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $invitations = $query->paginate(20);   // ← gunakan $query

        return view(
            Auth::user()?->role === 'admin'
                ? 'admin.invitations.index'
                : 'user.invitations.index',
            compact('invitations')
        );
    }

    /* ───────────────────────── CREATE ──────────────────────── */
    public function create()
    {
        return view(
            Auth::user()?->role === 'admin'
                ? 'admin.invitations.create'
                : 'user.invitations.create',
            [
                'themes' => Theme::all(),
                'users'  => Auth::user()?->role === 'admin' ? User::all() : null,
            ]
        );
    }

    /* ───────────────────────── STORE ───────────────────────── */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        // User biasa → tetapkan pemilik otomatis
        if (Auth::user()?->role !== 'admin') {
            $data['user_id'] = Auth::id();
        }

        // Slug unik
        $data['slug'] = Str::slug(
            "{$data['nama_pria']}-{$data['nama_wanita']}-" . Str::random(6)
        );

        Invitation::create($data);

        return to_route('invitations.index')->with('success', 'Undangan tersimpan');
    }

    /* ───────────────────────── EDIT ────────────────────────── */
    public function edit(Invitation $invitation)
    {
        // Tolak jika user coba mengedit milik orang lain
        if (Auth::user()?->role !== 'admin' && $invitation->user_id !== Auth::id()) {
            abort(403);
        }

        return view(
            Auth::user()?->role === 'admin'
                ? 'admin.invitations.edit'
                : 'user.invitations.edit',
            [
                'invitation' => $invitation,
                'themes'     => Theme::all(),
                'users'      => Auth::user()?->role === 'admin' ? User::all() : null,
            ]
        );
    }

    /* ───────────────────────── UPDATE ──────────────────────── */
    public function update(Request $request, Invitation $invitation)
    {
        if (Auth::user()?->role !== 'admin' && $invitation->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $this->validated($request);

        // User biasa tak boleh ubah pemilik
        if (Auth::user()?->role !== 'admin') {
            unset($data['user_id']);
        }

        $invitation->update($data);

        // ⬇️ redirect ke tabel
        return redirect()->route('invitations.index')
            ->with('success', 'Undangan berhasil diperbarui.');
    }


    /* ───────────────────────── DESTROY ─────────────────────── */
    public function destroy(Invitation $invitation)
    {
        if (Auth::user()?->role !== 'admin' && $invitation->user_id !== Auth::id()) {
            abort(403);
        }

        $invitation->delete();

        return back()->with('success', 'Undangan dihapus');
    }

    /* ──────────────────── VALIDATION HELPER ────────────────── */
    private function validated(Request $r): array
    {
        return $r->validate([
            'user_id'        => [Auth::user()->role === 'admin' ? 'required' : 'sometimes', 'exists:users,id'],
            'theme_id'       => ['required', 'exists:themes,id'],
            'nama_pria'      => ['required', 'string'],
            'nama_wanita'    => ['required', 'string'],
            'ortu_pria'      => ['required', 'string'],
            'ortu_wanita'    => ['required', 'string'],
            'anak_ke'        => ['required', 'string'],
            'tanggal'        => ['required', 'date'],
            'lokasi'         => ['required', 'string'],
            'no_telp'        => ['required', 'string'],
            'email'          => ['required', 'email'],
            'waktu_akad'     => ['required', 'string'],
            'waktu_resepsi'  => ['required', 'string'],
            'no_rekening'    => ['nullable', 'string'],
            'instagram'      => ['nullable', 'string'],
            'musik'          => ['nullable', 'string'],
        ]);
    }
}
