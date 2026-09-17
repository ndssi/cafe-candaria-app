<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organigram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganigramController extends Controller
{
    /**
     * FIX: halaman organigram sebelumnya HTML statis (hardcoded 2 baris),
     * sama sekali tidak membaca dari database.
     */
    public function index()
    {
        $organigrams = Organigram::all();
        return view('admin.organigram', compact('organigrams'));
    }

    public function create()
    {
        return view('admin.tambahorganigram');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:50',
            'jabatan' => 'required|string|max:50',
            // FITUR BARU: foto pengurus, dipakai untuk tampilan Pembina/Ketua dkk di halaman publik
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = [
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'foto'    => '',
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('organigram', 'public');
        }

        Organigram::create($data);

        return redirect()->route('admin.organigram')->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $organigram = Organigram::findOrFail($id);
        return view('admin.editorganigram', ['id' => $id, 'organigram' => $organigram]);
    }

    public function update(Request $request, $id)
    {
        $organigram = Organigram::findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:50',
            'jabatan' => 'required|string|max:50',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = [
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
        ];

        if ($request->hasFile('foto')) {
            if ($organigram->foto && Storage::disk('public')->exists($organigram->foto)) {
                Storage::disk('public')->delete($organigram->foto);
            }
            $data['foto'] = $request->file('foto')->store('organigram', 'public');
        }

        $organigram->update($data);

        return redirect()->route('admin.organigram')->with('success', 'Data pengurus berhasil diperbarui!');
    }

    public function destroyConfirm($id)
    {
        $organigram = Organigram::findOrFail($id);
        return view('admin.hapusorganigram', ['id' => $id, 'organigram' => $organigram]);
    }

    public function destroy($id)
    {
        $organigram = Organigram::findOrFail($id);

        if ($organigram->foto && Storage::disk('public')->exists($organigram->foto)) {
            Storage::disk('public')->delete($organigram->foto);
        }
        $organigram->delete();

        return redirect()->route('admin.organigram')->with('success', 'Pengurus berhasil dihapus!');
    }
}
