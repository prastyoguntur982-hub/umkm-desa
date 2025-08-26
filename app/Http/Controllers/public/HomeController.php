<?php

namespace App\Http\Controllers\public;

use App\Models\Umkm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $query = Umkm::with('photos');

        // Filter kategori (kecuali 'semua')
        if ($request->kategori && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Filter pencarian
        if ($request->search) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%')
                ->orWhere('nama_pemilik', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Paginasi (misal 9 per halaman)
        $umkms = $query->paginate(9);

        // Supaya pagination tetap bawa parameter search & kategori
        $umkms->appends([
            'kategori' => $request->kategori,
            'search'   => $request->search,
        ]);

        return view('public.home', compact('umkms'));
    }
}
