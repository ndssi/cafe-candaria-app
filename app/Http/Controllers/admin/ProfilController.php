<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Profil cafe disimpan sebagai satu baris data saja.
     * Helper ini mengambil baris itu, atau membuat baris kosong kalau belum ada.
     */
    protected function currentProfil(): Profil
    {
        $profil = Profil::first();

        if (!$profil) {
            $profil = Profil::create([
                'judul' => 'CAFE CANDARIA SMKN 2 PURWAKARTA',
                'isi'   => 'Cafe Candaria adalah kantin SMKN 2 PURWAKARTA yang di kelola dengan konsep cafe modern.',
                'gambar' => '',
            ]);
        }

        return $profil;
    }

    public function index()
    {
        $profil = $this->currentProfil();
        return view('admin.profil', compact('profil'));
    }

    public function edit()
    {
        $profil = $this->currentProfil();
        return view('admin.editprofil', compact('profil'));
    }

    /**
     * FIX: sebelumnya form edit profil submit ke url('/admin/profil/update')
     * yang tidak punya route sama sekali (404). Sekarang route + logic-nya nyata.
     */
    public function update(Request $request)
    {
        $profil = $this->currentProfil();

        $request->validate([
            'judul'   => 'nullable|string|max:100',
            'sejarah' => 'nullable|string',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = [
            'judul' => $request->input('judul', $profil->judul),
            'isi'   => $request->input('sejarah', $profil->isi),
        ];

        if ($request->hasFile('foto')) {
            if ($profil->gambar && Storage::disk('public')->exists($profil->gambar)) {
                Storage::disk('public')->delete($profil->gambar);
            }
            $data['gambar'] = $request->file('foto')->store('profil', 'public');
        }

        $profil->update($data);

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function deleteJudul()
    {
        $profil = $this->currentProfil();
        $profil->update(['judul' => '']);

        return redirect()->route('admin.profil')->with('success', 'Judul berhasil dihapus.');
    }

    public function deleteSejarah()
    {
        $profil = $this->currentProfil();
        $profil->update(['isi' => '']);

        return redirect()->route('admin.profil')->with('success', 'Sejarah berhasil dihapus.');
    }
}
