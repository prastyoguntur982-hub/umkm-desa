<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Galeri\Galeri;
use App\Http\Controllers\Controller;
use App\Models\Galeri\KategoriGaleri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{

    public function index()
    {
        $kategoriGaleri = KategoriGaleri::orderBy('tanggal', 'desc')->paginate(6);

        return view('public.galeri.index', compact('kategoriGaleri'));
    }

    public function create()
    {
        $kategoriGaleri = KategoriGaleri::all();
        $galeri = Galeri::with(['kategoriGaleri'])->get();


        return view('admin.galeri', compact('galeri', 'kategoriGaleri'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $results = KategoriGaleri::where('nama', 'like', "%{$query}%")
            ->orderBy('tanggal', 'desc')
            ->get(['id', 'nama', 'tanggal', 'foto', 'created_at']);

        return response()->json($results);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'kategori_galeri_id' => 'required|exists:kategori_galeris,id',

            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('kategori_galeri_id');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create($data);

        return redirect()->back()->with('success', 'Berhasil ditambah.');
    }
    public function storeKategoriGaleri(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('nama', 'tanggal');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('thumbnail_galeri', 'public');
        }

        KategoriGaleri::create($data);

        return redirect()->back()->with('success', 'Berhasil ditambah.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'foto' => 'nullable|image'
        ]);

        $kategori_galeri = KategoriGaleri::findOrFail($id);

        $data = $request->only(['nama', 'tanggal']);

        // Hapus foto lama jika ada file baru
        if ($request->hasFile('foto')) {
            if ($kategori_galeri->foto && Storage::disk('public')->exists($kategori_galeri->foto)) {
                Storage::disk('public')->delete($kategori_galeri->foto);
            }

            $data['foto'] = $request->file('foto')->store('thumbnail_galeri', 'public');
        }

        $kategori_galeri->update($data);

        return redirect()->route('admin.galeri.create')->with('success', 'Data barang berhasil diperbarui.');
    }


    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function destroyKategoriGaleri($id)
    {
        $data = KategoriGaleri::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }




    public function show($id)
    {
        $kategori = KategoriGaleri::findOrFail($id);
        $galeri = Galeri::where('kategori_galeri_id', $id)->get();

        return view('public.galeri.show', compact('galeri', 'kategori'));
    }
}
