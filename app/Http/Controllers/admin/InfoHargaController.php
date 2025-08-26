<?php

namespace App\Http\Controllers\admin;

use App\Models\Pasar\Pasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\InfoHarga\DaftarHarga;
use App\Models\InfoHarga\DaftarBarang;
use Illuminate\Support\Facades\Storage;


class InfoHargaController extends Controller
{
    public function index(Request $request)
    {
        $latestHarga = DB::table('daftar_harga as dh1')
            ->whereRaw('NOT EXISTS (
        SELECT 1 FROM daftar_harga as dh2
        WHERE dh2.barang_id = dh1.barang_id
        AND dh2.pasar_id = dh1.pasar_id
        AND dh2.tanggal > dh1.tanggal
    )');

        $rataHargaPerBarang = DB::table(DB::raw("({$latestHarga->toSql()}) as latest"))
            ->mergeBindings($latestHarga)
            ->join('daftar_barang', 'latest.barang_id', '=', 'daftar_barang.id')
            ->select(
                'latest.barang_id',
                'daftar_barang.nama as nama_barang',
                'daftar_barang.foto',
                'daftar_barang.satuan',
                DB::raw('AVG(latest.harga) as rata_harga')
            )
            ->groupBy('latest.barang_id', 'daftar_barang.nama', 'daftar_barang.foto', 'daftar_barang.satuan')

            ->paginate(8);

        return view('public.info-harga.index', compact('rataHargaPerBarang'));
    }

    public function search(Request $request)
    {
        $query = $request->query('query');


        $latestHarga = DB::table('daftar_harga as dh1')
            ->whereRaw('NOT EXISTS (
            SELECT 1 FROM daftar_harga as dh2
            WHERE dh2.barang_id = dh1.barang_id
            AND dh2.pasar_id = dh1.pasar_id
            AND dh2.tanggal > dh1.tanggal
        )');


        $results = DB::table(DB::raw("({$latestHarga->toSql()}) as latest"))
            ->mergeBindings($latestHarga)
            ->join('daftar_barang', 'latest.barang_id', '=', 'daftar_barang.id')
            ->select(
                'latest.barang_id as id',
                'daftar_barang.nama as nama',
                'daftar_barang.foto',
                'daftar_barang.satuan',
                DB::raw('AVG(latest.harga) as rata_harga')
            )
            ->where('daftar_barang.nama', 'like', "%$query%")
            ->groupBy('latest.barang_id', 'daftar_barang.nama', 'daftar_barang.foto', 'daftar_barang.satuan')
            ->take(20)
            ->get();

        return response()->json($results);
    }

    public function create()
    {
        $pasars = Pasar::all();
        $daftar_barang = DaftarBarang::all();
        $daftar_harga = DaftarHarga::with(['pasar', 'daftarBarang'])->get();

        return view('admin.info-harga', compact('pasars', 'daftar_harga', 'daftar_barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'nullable|string|max:255',
            'satuan'    => 'nullable|string',
            'foto'      => 'nullable|image|max:2048',
            'pasar_id'  => 'nullable|exists:pasars,id',
            'barang_id' => 'nullable|exists:daftar_barang,id',
            'harga'     => 'nullable|string', // Harga sebagai string untuk bisa difilter dari titik
            'tanggal'   => 'nullable|date',
        ]);

        DB::beginTransaction();

        try {
            // Jika nama dan satuan diisi, maka buat data baru ke tabel daftar_barang
            if ($request->filled(['nama', 'satuan'])) {
                $barangData = $request->only('nama', 'satuan');

                // Jika foto diupload
                if ($request->hasFile('foto')) {
                    $barangData['foto'] = $request->file('foto')->store('komoditas_pasar', 'public');
                }

                DaftarBarang::create($barangData);
            }

            // Jika pasar_id, barang_id, harga, dan tanggal diisi, maka buat data ke tabel daftar_harga
            if ($request->filled(['pasar_id', 'barang_id', 'harga', 'tanggal'])) {
                // Hapus titik pada harga (misal: 10.000 jadi 10000)
                $harga = (int) str_replace('.', '', $request->harga);

                DaftarHarga::create([
                    'pasar_id'  => $request->pasar_id,
                    'barang_id' => $request->barang_id,
                    'harga'     => $harga,
                    'tanggal'   => $request->tanggal,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'satuan' => 'required',
            'foto' => 'nullable|image'
        ]);

        $daftar_barang = DaftarBarang::findOrFail($id);

        $data = $request->only(['nama', 'satuan']);

        // Hapus foto lama jika ada file baru
        if ($request->hasFile('foto')) {
            if ($daftar_barang->foto && Storage::disk('public')->exists($daftar_barang->foto)) {
                Storage::disk('public')->delete($daftar_barang->foto);
            }

            $data['foto'] = $request->file('foto')->store('komoditas_pasar', 'public');
        }

        $daftar_barang->update($data);

        return redirect()->route('admin.info-harga.create')->with('success', 'Data barang berhasil diperbarui.');
    }


    public function destroyBarang($id)
    {
        $barang = DaftarBarang::findOrFail($id);

        // Hapus foto jika ada
        if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        return redirect()->back()->with('success', 'Data barang berhasil dihapus.');
    }
    public function destroyHarga($id)
    {
        $data = DaftarHarga::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('success', 'Data barang berhasil dihapus.');
    }

    public function show($id)
    {
        $latestHarga = DB::table('daftar_harga as dh1')
            ->where('dh1.barang_id', $id)
            ->whereRaw('NOT EXISTS (
            SELECT 1 FROM daftar_harga as dh2
            WHERE dh2.barang_id = dh1.barang_id
            AND dh2.pasar_id = dh1.pasar_id
            AND dh2.tanggal > dh1.tanggal
        )');

        $data = DB::table(DB::raw("({$latestHarga->toSql()}) as latest"))
            ->mergeBindings($latestHarga)
            ->join('pasars', 'latest.pasar_id', '=', 'pasars.id')
            ->select('latest.harga', 'pasars.nama as nama_pasar', 'latest.tanggal', 'pasars.id as pasar_id')
            ->get();


        $barang = DB::table('daftar_barang')->where('id', $id)->first();


        return view('public.info-harga.show', compact('data', 'barang'));
    }
}
