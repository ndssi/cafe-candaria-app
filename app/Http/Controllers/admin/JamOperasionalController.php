<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamOperasional;
use Illuminate\Http\Request;

class JamOperasionalController extends Controller
{
    public function index()
    {
        $jam_operasional = JamOperasional::all();
        return view('admin.jam-operasional', compact('jam_operasional'));
    }

    public function edit($id)
    {
        $item = JamOperasional::findOrFail($id);
        return view('admin.editjamoperasional', ['id' => $id, 'item' => $item]);
    }

    public function update(Request $request, $id)
    {
        $item = JamOperasional::findOrFail($id);

        $request->validate([
            'hari'      => 'required|string|max:50',
            'jam_buka'  => 'nullable|string|max:20',
            'jam_tutup' => 'nullable|string|max:20',
        ]);

        $item->update([
            'hari'      => $request->hari,
            'jam_buka'  => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
        ]);

        return redirect()->route('admin.jam-operasional')->with('success', 'Jam operasional berhasil diperbarui!');
    }

    public function destroyConfirm($id)
    {
        $item = JamOperasional::findOrFail($id);
        return view('admin.hapusjamoperasional', ['id' => $id, 'item' => $item]);
    }

    public function destroy($id)
    {
        $item = JamOperasional::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.jam-operasional')->with('success', 'Data berhasil dihapus!');
    }
}
