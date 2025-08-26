<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmPhoto;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::with('photos')->latest()->get();
        return view('admin.umkm', compact('umkms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'    => 'required|string|max:255',
            'nama_pemilik'   => 'required|string|max:255',
            'kategori'       => 'required|string|max:50', // tambahkan validasi kategori
            'deskripsi'      => 'nullable|string',
            'lokasi'         => 'nullable|string',
            'link_wa'        => 'nullable|string',
            'link_shopee'    => 'nullable|url',
            'link_tokopedia' => 'nullable|url',
            'link_tiktok'    => 'nullable|url',
            'primary_photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'photos.*'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan primary photo
        $primaryPhotoPath = null;
        if ($request->hasFile('primary_photo')) {
            $primaryPhotoPath = $request->file('primary_photo')->store('umkm', 'public');
        }

        // Format nomor WhatsApp
        $wa = $request->link_wa;
        if ($wa) {
            $wa = preg_replace('/^0/', '', $wa); // hapus 0 di depan jika ada
            $wa = '+62' . $wa;
        }

        // Simpan data UMKM
        $umkm = Umkm::create([
            'nama_produk'    => $request->nama_produk,
            'nama_pemilik'   => $request->nama_pemilik,
            'kategori'       => $request->kategori, // simpan kategori
            'deskripsi'      => $request->deskripsi,
            'lokasi'         => $request->lokasi,
            'link_wa'        => $wa,
            'link_shopee'    => $request->link_shopee,
            'link_tokopedia' => $request->link_tokopedia,
            'link_tiktok'    => $request->link_tiktok,
            'primary_photo'  => $primaryPhotoPath,
        ]);

        // Simpan foto tambahan
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('umkm', 'public');
                UmkmPhoto::create([
                    'umkm_id' => $umkm->id,
                    'photo'   => $path,
                ]);
            }
        }

        return redirect()->route('admin.umkms.index')->with('success', 'UMKM berhasil ditambahkan');
    }

    public function edit(Umkm $umkm)
    {
        return view('admin.umkm-edit', compact('umkm'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'kategori'     => 'required|string|max:50', // tambahkan validasi kategori
            'deskripsi'   => 'nullable|string',
            'lokasi'      => 'nullable|string',
            'link_wa'     => 'nullable|string|max:255',
            'link_shopee' => 'nullable|url',
            'link_tokopedia' => 'nullable|url',
            'link_tiktok' => 'nullable|url',
            'primary_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'photos.*'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update primary photo jika ada
        if ($request->hasFile('primary_photo')) {
            $primaryPhotoPath = $request->file('primary_photo')->store('umkm', 'public');
            $umkm->primary_photo = $primaryPhotoPath;
        }

        // Format WA
        $wa = $request->link_wa;
        if ($wa) {
            $wa = preg_replace('/^0/', '', $wa);
            $wa = '+62' . $wa;
        }

        $umkm->update([
            'nama_produk'    => $request->nama_produk,
            'nama_pemilik'   => $request->nama_pemilik,
            'kategori'       => $request->kategori, // update kategori
            'deskripsi'      => $request->deskripsi,
            'lokasi'         => $request->lokasi,
            'link_wa'        => $wa,
            'link_shopee'    => $request->link_shopee,
            'link_tokopedia' => $request->link_tokopedia,
            'link_tiktok'    => $request->link_tiktok,
        ]);

        // Hapus foto yang ditandai di UI
        if ($request->has('removed_photos')) {
            UmkmPhoto::whereIn('id', $request->removed_photos)->delete();
        }

        // Tambah foto baru
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('umkm', 'public');
                UmkmPhoto::create([
                    'umkm_id' => $umkm->id,
                    'photo'   => $path,
                ]);
            }
        }

        return redirect()->route('admin.umkms.index')->with('success', 'UMKM berhasil diperbarui');
    }

    public function destroy(Umkm $umkm)
    {
        $umkm->delete();
        return redirect()->route('admin.umkms.index')->with('success', 'UMKM berhasil dihapus');
    }
}
