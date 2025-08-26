<?php

namespace App\Http\Controllers\admin;

use App\Models\Formulir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 
class FormulirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formulir = Formulir::all();

        return view('admin.formulir', compact('formulir'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $existing = Formulir::where('kategori', $request->kategori)->first();

        if ($existing) {
            return redirect()->back()->with('warning', 'Kategori sudah tersedia. Silakan edit URL-nya melalui kategori terkait');
        }

        Formulir::create([
            'kategori' => $request->kategori,
            'url' => $request->url,
        ]);

        return redirect()->back()->with('success', 'Formulir berhasil ditambah.');
    }

    public function update(Request $request, Formulir $formulir)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $data = ['url' => $request->input('url')];

        $formulir->update($data);

        return redirect()->route('admin.formulir.index')->with('success', 'Berhasil diperbarui.');
    }



    public function destroy(Formulir $formulir)
    {
        $formulir->delete();
        return redirect()->route('admin.formulir.index')->with('success', 'Pasar berhasil dihapus.');
    }
}
