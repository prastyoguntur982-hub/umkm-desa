<?php

namespace App\Http\Controllers\admin;

use App\Models\Berita;
use App\Models\Pasar\Pasar;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// 
class DashboardController extends Controller
{

    public function index()
    {
        // Ambil rata-rata harga terbaru
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
                DB::raw('AVG(latest.harga) as rata_harga_terbaru')
            )
            ->groupBy('latest.barang_id', 'daftar_barang.nama', 'daftar_barang.foto', 'daftar_barang.satuan')
            ->get();

        // Ambil rata-rata harga sebelumnya 
        $latestTanggal = DB::table('daftar_harga as dh1')
            ->select('dh1.barang_id', 'dh1.pasar_id', DB::raw('MAX(dh1.tanggal) as max_tanggal'))
            ->groupBy('dh1.barang_id', 'dh1.pasar_id');

        $previousTanggal = DB::table('daftar_harga as dh2')
            ->joinSub($latestTanggal, 'latest', function ($join) {
                $join->on('dh2.barang_id', '=', 'latest.barang_id')
                    ->on('dh2.pasar_id', '=', 'latest.pasar_id');
            })
            ->select('dh2.barang_id', 'dh2.pasar_id', DB::raw('MAX(dh2.tanggal) as prev_tanggal'))
            ->whereColumn('dh2.tanggal', '<', 'latest.max_tanggal')
            ->groupBy('dh2.barang_id', 'dh2.pasar_id');

        $previousHarga = DB::table('daftar_harga as dh3')
            ->select('dh3.barang_id', 'dh3.pasar_id', 'dh3.tanggal', 'dh3.harga')
            ->joinSub($previousTanggal, 'prev', function ($join) {
                $join->on('dh3.barang_id', '=', 'prev.barang_id')
                    ->on('dh3.pasar_id', '=', 'prev.pasar_id')
                    ->on('dh3.tanggal', '=', 'prev.prev_tanggal');
            });

        $rataHargaSebelumnya = DB::table(DB::raw("({$previousHarga->toSql()}) as prev_harga"))
            ->mergeBindings($previousHarga)
            ->join('daftar_barang', 'prev_harga.barang_id', '=', 'daftar_barang.id')
            ->select(
                'prev_harga.barang_id',
                DB::raw('AVG(prev_harga.harga) as rata_harga_sebelumnya')
            )
            ->groupBy('prev_harga.barang_id')
            ->get();

        // Gabungkan data berdasarkan barang_id
        $data = [];

        foreach ($rataHargaPerBarang as $item) {
            $sebelumnya = $rataHargaSebelumnya->firstWhere('barang_id', $item->barang_id);
            $hargaSebelumnya = $sebelumnya ? $sebelumnya->rata_harga_sebelumnya : 0;
            $hargaTerbaru = $item->rata_harga_terbaru;

            $perubahan = $hargaTerbaru - $hargaSebelumnya;
            $persentase = $hargaSebelumnya > 0 ? ($perubahan / $hargaSebelumnya) * 100 : 0;

            $data[] = [
                'nama_barang' => $item->nama_barang,
                'satuan' => $item->satuan,
                'harga_terbaru' => $hargaTerbaru,
                'harga_sebelumnya' => $hargaSebelumnya,
                'perubahan' => $perubahan,
                'persentase' => $persentase,
            ];
        }

        $totalPengunjung = DB::table('pengunjung')->count();


        $totalPostingan = Berita::count();

        $totalPasar = Pasar::count();

        return view('admin.dashboard', compact('data', 'totalPengunjung', 'totalPostingan', 'totalPasar'));
    }
}
