<?php

namespace App\Http\Controllers\admin;
// 
use Illuminate\Http\Request;

use App\Models\StrukturOrganisasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $struktur = StrukturOrganisasi::all();

        // Convert ke JSON
        return view('admin.struktur-organisasi', [
            'strukturJson' => $struktur->toJson(),
            'struktur' => $struktur
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'parent_id' => 'nullable|exists:struktur_organisasi,id',
        ]);

        if ($request->parent_id) {
            $latestId = StrukturOrganisasi::max('id') ?? 0;
            if ((int)$request->parent_id > $latestId) {
                return redirect()->back()->withErrors(['parent_id' => 'Parent ID tidak valid.'])->withInput();
            }
        }

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('strukturOrganisasi', 'public');
        } else {
            $path = null;  
        }

        StrukturOrganisasi::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
            'foto' => $path,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }



    public function update(Request $request, StrukturOrganisasi $strukturOrganisasi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'parent_id' => 'nullable|exists:struktur_organisasi,id',
        ]);

        // Cek agar parent_id tidak sama dengan dirinya sendiri
        if ($request->parent_id == $strukturOrganisasi->id) {
            return redirect()->back()->withErrors(['parent_id' => 'Parent ID tidak boleh sama dengan ID sendiri.'])->withInput();
        }

        // Cek agar parent_id tidak lebih kecil dari dirinya sendiri (agar tidak membuat parent di bawah node ini)
        if ($request->parent_id && $request->parent_id > $strukturOrganisasi->id) {
            return redirect()->back()->withErrors(['parent_id' => 'Parent ID tidak boleh dari data yang berada di bawah posisi ini.'])->withInput();
        }

        $data = $request->only('nama', 'jabatan', 'nip', 'parent_id');

        if ($request->hasFile('foto')) {
            if ($strukturOrganisasi->foto && Storage::disk('public')->exists($strukturOrganisasi->foto)) {
                Storage::disk('public')->delete($strukturOrganisasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('strukturOrganisasi', 'public');
        }

        $strukturOrganisasi->update($data);

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data struktur organisasi berhasil diperbarui.');
    }


    public function destroy(StrukturOrganisasi $strukturOrganisasi)
    {
        // Hapus file foto jika ada
        if ($strukturOrganisasi->foto && Storage::disk('public')->exists($strukturOrganisasi->foto)) {
            Storage::disk('public')->delete($strukturOrganisasi->foto);
        }

        // Hapus data dari database
        $strukturOrganisasi->delete();

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data struktur organisasi berhasil dihapus.');
    }

    public function show()
    {
        $flatData = StrukturOrganisasi::all();
        return view('public.struktur-organisasi', compact('flatData'));
    }
}
