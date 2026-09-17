<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * FIX: route lama `return view('admin.menu');` tanpa data,
     * jadi tabel menu selalu kosong walau data ada di database.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu', compact('menus'));
    }

    public function create()
    {
        return view('admin.tambahmenu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'kategori'  => 'required|in:Minuman,Makanan',
            'deskripsi' => 'nullable|string',
            'harga'     => 'required|string|max:20',
            // FITUR BARU: foto menu, dipakai untuk ditampilkan di halaman publik
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = [
            'nama_menu' => $request->nama_menu,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi ?? '',
            'harga'     => $request->harga,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.editmenu', ['id' => $id, 'menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'kategori'  => 'required|in:Minuman,Makanan',
            'harga'     => 'required|string|max:20',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $data = [
            'nama_menu' => $request->nama_menu,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi ?? $menu->deskripsi,
            'harga'     => $request->harga,
        ];

        if ($request->hasFile('gambar')) {
            if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroyConfirm($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.hapusmenu', ['id' => $id, 'menu' => $menu]);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }
        $menu->delete();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus!');
    }
}
