<?php

namespace App\Http\Controllers\admin;

use App\Models\Alur;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AlurController extends Controller
{
    public function index()
    {
        $alur = Alur::all();

        return view('admin.alur', compact('alur'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'uu_terkait' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'gambar' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        $path = $request->file('gambar')->store('Alur', 'public');

        Alur::create([
            'kategori' => $request->kategori,
            'uu_terkait' => $request->uu_terkait,
            'keterangan' => $request->keterangan,
            'gambar' => $path,
        ]);

        return redirect()->back()->with('success', 'Berhasil ditambah.');
    }


    public function update(Request $request, Alur $alur)
    {
        $request->validate([
            'kategori' => 'required|string',
            'uu_terkait' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',

        ]);

        $data = $request->only('kategori', 'uu_terkait', 'keterangan');

        if ($request->hasFile('gambar')) {
            if ($alur->gambar && Storage::disk('public')->exists($alur->gambar)) {
                Storage::disk('public')->delete($alur->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('Alur', 'public');
        }

        $alur->update($data);

        return redirect()->route('admin.alur.index')->with('success', 'Berhasil diperbarui.');
    }


    public function destroy(Alur $alur)
    {
        // Hapus file jika ada
        if ($alur->gambar && Storage::disk('public')->exists($alur->gambar)) {
            Storage::disk('public')->delete($alur->gambar);
        }


        // Hapus data dari database
        $alur->delete();

        return redirect()->route('admin.alur.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show($slug)
    {
        // Konversi slug ke kalimat biasa
        $kategori = Str::of($slug)->replace('-', ' ')->lower()->ucfirst();

        // Cari data berdasarkan kategori
        $data = Alur::whereRaw('LOWER(kategori) = ?', [strtolower($kategori)])->first();


        return view('public.alur', compact('data', 'kategori'));
    }
}
