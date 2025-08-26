<?php

namespace App\Http\Controllers\admin;

use App\Models\Ppid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
// 
class PpidController extends Controller
{
    public function index()
    {
        $ppid = Ppid::all();

        return view('admin.ppid', compact('ppid'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'judul' => 'required|string',
            'keterangan' => 'required|string|max:255',
            'berkas' => 'required|file|mimes:pdf,docx,xls,xlsx|max:2048',
        ]);

        // Simpan file ke storage/app/public/dokumen_ppid
        $path = $request->file('berkas')->store('dokumen_ppid', 'public');

        Ppid::create([
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'berkas' => $path, // Simpan path file
        ]);

        return redirect()->back()->with('success', 'Berkas berhasil ditambah.');
    }


    public function update(Request $request, Ppid $ppid)
    {
        $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'keterangan' => 'required',
            'berkas' => 'nullable|file|mimes:pdf,docx,xls,xlsx|max:2048',
        ]);

        $data = $request->only('kategori', 'judul', 'keterangan');

        if ($request->hasFile('berkas')) {
            if ($ppid->berkas && Storage::disk('public')->exists($ppid->berkas)) {
                Storage::disk('public')->delete($ppid->berkas);
            }

            $data['berkas'] = $request->file('berkas')->store('dokumen_ppid', 'public');
        }

        $ppid->update($data);

        return redirect()->route('admin.ppid.index')->with('success', 'Berhasil diperbarui.');
    }


    public function destroy(Ppid $ppid)
    {
        // Hapus file jika ada
        if ($ppid->berkas && Storage::disk('public')->exists($ppid->berkas)) {
            Storage::disk('public')->delete($ppid->berkas);
        }


        // Hapus data dari database
        $ppid->delete();

        return redirect()->route('admin.ppid.index')->with('success', 'Data berhasil dihapus.');
    }

    public function unduh($id)
    {
        $ppid = Ppid::findOrFail($id);

        $path = storage_path('app/public/' . $ppid->berkas);

        if (!file_exists($path)) {
            abort(404);
        }

        // Ambil ekstensi asli dari file yang disimpan
        $extension = pathinfo($ppid->berkas, PATHINFO_EXTENSION);

        // Buat nama file baru berdasarkan judul + ekstensi
        $filename = $ppid->judul . '.' . $extension;

        return response()->download($path, $filename);
    }



    public function show($slug)
    {
        // Konversi slug ke kalimat biasa
        $kategori = Str::of($slug)->replace('-', ' ')->lower()->ucfirst();

        // Cari data berdasarkan kategori
        $data = Ppid::whereRaw('LOWER(kategori) = ?', [strtolower($kategori)])->get();

        return view('public.ppid', compact('data', 'kategori'));
    }
}
