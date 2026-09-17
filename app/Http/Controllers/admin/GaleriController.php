<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galleries = Galeri::all();
        return view('admin.galeri', compact('galleries'));
    }

    /**
     * FITUR BARU: sebelumnya tidak ada halaman/route untuk menambah foto galeri sama sekali.
     */
    public function create()
    {
        return view('admin.tambahgaleri');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:100',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        Galeri::create([
            'gambar'     => $path,
            'keterangan' => $request->keterangan ?? '',
        ]);

        return redirect()->route('admin.galeri')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.editgaleri', ['id' => $id, 'galeri' => $galeri]);
    }

    /**
     * FIX: form edit sebelumnya method="GET" dan action-nya balik ke halaman
     * list galeri, jadi perubahan tidak pernah benar-benar tersimpan.
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'keterangan' => 'nullable|string|max:100',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = [
            'keterangan' => $request->input('keterangan', $galeri->keterangan),
        ];

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroyConfirm($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.hapusgaleri', ['id' => $id, 'galeri' => $galeri]);
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $galeri->delete();

        return redirect()->route('admin.galeri')->with('success', 'Foto galeri berhasil dihapus!');
    }
}
