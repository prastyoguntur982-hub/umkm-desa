<?php

namespace App\Http\Controllers\admin;

use App\Models\Berita;
use App\Models\BeritaView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{

    public function index(Request $request)
    {
        $semuaBerita = Berita::latest()->paginate(6);

        $berita_populer = Berita::withCount('views')
            ->orderBy('views_count', 'desc')
            ->limit(5)
            ->get();



        return view('public.berita.index', compact('semuaBerita', 'berita_populer'));
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $perPage = 6; // misal 6 berita per halaman

        $results = Berita::withCount('views')
            ->where('judul', 'like', "%$query%")
            ->orWhere('isi', 'like', "%$query%")
            ->paginate($perPage);

        return response()->json($results);
    }




    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'slug' => 'required|string|max:255|unique:berita,slug', // Tambahkan unique jika slug harus unik
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required|string',
        ]);

        $data = $request->only('judul', 'slug', 'isi');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('berita', 'public');
        }

        Berita::create($data);


        return redirect()->back()->with('success', 'Berita berhasil ditambah.');
    }

    public function create()
    {
        $berita = Berita::All();
        return view('admin.berita', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'slug' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image'
        ]);

        $berita = Berita::findOrFail($id);

        $data = $request->only(['judul', 'slug', 'isi']);

        // Hapus foto lama jika ada file baru
        if ($request->hasFile('foto')) {
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }

            $data['foto'] = $request->file('foto')->store('komoditas_pasar', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.create')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroyBerita($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->back()->with('success', 'Berhasil dihapus.');
    }


    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();

        $ip = request()->ip();
        $userAgent = request()->header('User-Agent');

        // Cek kunjungan hari ini
        $sudahDilihat = BeritaView::where('berita_id', $berita->id)
            ->where('ip_address', $ip)
            ->where('user_agent', $userAgent)
            ->whereDate('viewed_at', now()->toDateString())
            ->exists();

        if (!$sudahDilihat) {
            BeritaView::create([
                'berita_id' => $berita->id,
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'viewed_at' => now(),
            ]);
        }

        $berita_terbaru = Berita::latest()->where('id', '!=', $berita->id)->take(5)->get();

        $viewCount = $berita->views()->count();

        return view('public.berita.show', compact('berita', 'viewCount', 'berita_terbaru'));
    }
}
