<?php
 
namespace App\Http\Controllers\admin;
use App\Models\Pasar\Pasar;
use App\Models\Pasar\detailPasar;
use App\Models\Pasar\dokumenPasar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasarController extends Controller
{
    public function index(Request $request)
    {
        $pasar = Pasar::latest()->paginate(9);

        return view('public.pasar.index', compact('pasar'));
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        $results = Pasar::where('nama', 'like', "%$query%")
            ->orWhere('alamat', 'like', "%$query%")
            ->latest()
            ->take(20)
            ->get();

        return response()->json($results);
    }


    public function create()
    {
        $pasars = Pasar::all();
        $detailPasars = DetailPasar::with('pasar')->get();
        $dokumenPasars = DokumenPasar::with('pasar')->get();

        return view('admin.data-pasar', compact('pasars', 'detailPasars', 'dokumenPasars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('nama', 'alamat');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_pasar', 'public');
        }

        Pasar::create($data);


        return redirect()->back()->with('success', 'pasar berhasil ditambah.');
    }



    public function storeDetail(Request $request)
    {

        $request->validate([
            'pasar_id' => 'required|exists:pasars,id',
            'kategori' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        DetailPasar::create([
            'pasar_id' => $request->pasar_id,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Detail pasar berhasil ditambah.');
    }

    public function storeDokumenPasar(Request $request)
    {
        $request->validate([
            'pasar_id' => 'required|exists:pasars,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'berkas' => 'required|file|mimes:pdf,docx,xls,xlsx|max:2048',
        ]);

        $filePath = $request->file('berkas')->store('dokumen-pasar', 'public');

        DokumenPasar::create([
            'pasar_id' => $request->pasar_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'berkas' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Detail pasar berhasil ditambah.');
    }

    public function update(Request $request, Pasar $pasar)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image'
        ]);

        $data = $request->only('nama', 'alamat');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_pasar', 'public');
        }

        $pasar->update($data);

        return redirect()->route('admin.pasars.create')->with('success', 'Pasar berhasil diperbarui.');
    }

    public function updateDetail(Request $request, $id)
    {
        $request->validate([
            'pasar_id' => 'required|exists:pasars,id',
            'kategori' => 'nullable|string',
            'keterangan' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $detail = DetailPasar::findOrFail($id);

        $detail->update($request->only(['pasar_id', 'kategori', 'keterangan', 'deskripsi']));

        return redirect()->back()->with('success', 'Detail pasar berhasil diperbarui.');
    }
    public function updateDokumen(Request $request, $id)
    {
        $request->validate([
            'pasar_id' => 'required|exists:pasars,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'berkas' => 'nullable|file|mimes:pdf,docx,xls,xlsx|max:2048'
        ]);

        $dokumen = DokumenPasar::findOrFail($id);

        $dokumen->update($request->only(['pasar_id', 'judul', 'deskripsi', 'berkas']));

        return redirect()->back()->with('success', 'Dokumen pasar berhasil diperbarui.');
    }

    public function unduh($id)
    {
        $dokumen = DokumenPasar::findOrFail($id);

        $path = storage_path('app/public/' . $dokumen->berkas);

        if (!file_exists($path)) {
            abort(404);
        }


        $extension = pathinfo($dokumen->berkas, PATHINFO_EXTENSION);


        $filename = $dokumen->judul . '.' . $extension;

        return response()->download($path, $filename);
    }

    public function destroy(Pasar $pasar)
    {
        $pasar->delete();
        return redirect()->route('admin.pasars.create')->with('success', 'Pasar berhasil dihapus.');
    }

    public function destroyDetail($id)
    {
        $detail = DetailPasar::findOrFail($id);
        $detail->delete();

        return redirect()->back()->with('success', 'Detail pasar berhasil dihapus.');
    }

    public function destroyDokumen($id)
    {
        $dokumen = DokumenPasar::findOrFail($id);
        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen pasar berhasil dihapus.');
    }


    
    public function show($id)
    {
        $pasar = Pasar::findOrFail($id);

        // Group detailPasar by kategori (case-insensitive)
        $groupedItems = $pasar->detailPasar->groupBy(function ($item) {
            return strtolower($item->kategori);
        });

        $dokumens = $pasar->dokumen()->latest()->paginate(3);

        return view('public.pasar.show', compact('pasar', 'dokumens', 'groupedItems'));
    }
}
