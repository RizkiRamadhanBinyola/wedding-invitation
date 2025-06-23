<?php

namespace App\Http\Controllers;

use App\Models\{Invitation, Theme};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InvitationSectionController extends Controller
{
    public function dashboard(Invitation $invitation)
    {
        // Batasi agar user biasa cuma boleh lihat miliknya
        if (Auth::user()->role !== 'admin' && $invitation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('invitations.manage', compact('invitation'));
    }

    /* ───────  PENGANTIN  ─────── */
    public function editPengantin(Invitation $invitation)
    {
        return view('invitations.sections.pengantin', compact('invitation'));
    }

    public function updatePengantin(Request $r, Invitation $invitation)
    {
        $data = $r->validate([
            'nama_pria'   => 'required',
            'nama_wanita' => 'required',
            'ortu_pria'   => 'required',
            'ortu_wanita' => 'required',
            'anak_ke'     => 'required',
        ]);
        $invitation->update($data);
        return back()->with('success', 'Data pengantin tersimpan');
    }


    /* ───────  ACARA  ─────── */
    public function editAcara(Invitation $invitation)
    {
        return view('invitations.sections.acara', compact('invitation'));
    }

    public function updateAcara(Request $r, Invitation $invitation)
    {
        $data = $r->validate([
            'tanggal'       => 'required|date',
            'lokasi'        => 'required',
            'waktu_akad'    => 'required',
            'waktu_resepsi' => 'required',
        ]);
        $invitation->update($data);
        return back()->with('success', 'Data acara tersimpan');
    }


    /* ───────  TEMA  ─────── */
    public function editTema(Invitation $invitation)
    {
        $themes = Theme::all();
        return view('invitations.sections.tema', compact('invitation', 'themes'));
    }

    public function updateTema(Request $r, Invitation $invitation)
    {
        $data = $r->validate(['theme_id' => 'required|exists:themes,id']);
        $invitation->update($data);
        return back()->with('success', 'Tema berhasil diganti');
    }


    /* ───────  MUSIK  ─────── */
    public function editMusik(Invitation $invitation)
    {
        return view('invitations.sections.musik', compact('invitation'));
    }

    public function updateMusik(Request $r, Invitation $invitation)
    {
        $data = $r->validate(['musik' => 'nullable|string']);
        $invitation->update($data);
        return back()->with('success', 'Musik diperbarui');
    }


    /* ------------  GALERI  ------------ */

    public function editGaleri(Invitation $invitation)
    {
        $invitation->load('galleries');            // relasi kini valid
        return view('invitations.sections.galeri', compact('invitation'));
    }

    public function storeGaleri(Request $r, Invitation $invitation)
    {
        $data = $r->validate([
            'image'   => 'required|image|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $data['image']->store('galeri', 'public');   // simpan di storage/app/public/galeri
        $invitation->galleries()->create([
            'path'    => $path,
            'caption' => $data['caption'] ?? null,
        ]);

        return back()->with('success', 'Foto di-upload');
    }

    public function destroyGaleri(Invitation $invitation, $imageId)
    {
        $g = $invitation->galleries()->findOrFail($imageId);

        \Illuminate\Support\Facades\Storage::disk('public')->delete($g->path);
        $g->delete();

        return back()->with('success', 'Foto dihapus');
    }
}
