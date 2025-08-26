<?php


namespace App\View\Components\Public;

use Illuminate\View\Component;
use App\Models\Formulir;

class Navbar extends Component
{
    public $formulirs;
    public $formulirPermohonanPPID;

    public function __construct()
    {
        $kategoriList = [
            'Formulir Pengajuan Keberatan',
            'Formulir Permintaan Informasi Publik',
            'Formulir Pengaduan',
        ];

        // Semua formulir untuk dropdown Pelayanan
        $this->formulirs = Formulir::whereIn('kategori', $kategoriList)
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('kategori');

        // Ambil khusus formulir dengan kategori 'Formulir Permohonan' untuk PPID (ambil satu)
        $this->formulirPermohonanPPID = Formulir::where('kategori', 'Formulir Permohonan')->first();
    }

    public function render()
    {
        return view('components.public.navbar', [
            'formulirs' => $this->formulirs,
            'formulirPermohonanPPID' => $this->formulirPermohonanPPID,
        ]);
    }
}
