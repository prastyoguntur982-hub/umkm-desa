<?php

namespace App\Http\Controllers\admin;

use App\Models\Balai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BalaiController extends Controller
{
    public function index()
    {
        $balai = Balai::all();

        return view('admin.balai', compact('balai'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori'   => 'required|string|max:255',
            'alamat'     => 'required|string',
            'deskripsi'  => 'nullable|string',
        ]);

        $existing = Balai::where('kategori', $request->kategori)->first();

        if ($existing) {
            return redirect()->back()->with('warning', 'Kategori sudah tersedia. Silakan edit data berdasarkan kategori terkait');
        }

        Balai::create($validated);

        return redirect()->back()->with('success', 'Data berhasil ditambah.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori'   => 'required|string|max:255',
            'alamat'     => 'required|string',
            'deskripsi'  => 'nullable|string',
        ]);

        $balai = Balai::findOrFail($id);

        $balai->update([
            'kategori'  => $request->kategori,
            'alamat'    => $request->alamat,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'data berhasil diperbarui.');
    }

    public function show($slug)
    {
        $kategori = Str::of($slug)->replace('-', ' ')->lower();

        $balai = Balai::where('kategori', $kategori)->first();

        return view('public.balai', compact('balai', 'kategori'));
    }

    public function destroy($id)
    {
        $balai = Balai::findOrFail($id);
        $balai->delete();

        return redirect()->route('admin.balai.index')->with('success', 'Data berhasil dihapus.');
    }
}
