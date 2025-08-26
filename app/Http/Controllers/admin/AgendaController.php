<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::all();

        return view('admin.agenda', compact('agenda'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'acara' => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'foto' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan file ke storage/app/public/dokumen_ppid
        $path = $request->file('foto')->store('agenda', 'public');

        Agenda::create([
            'acara' => $request->acara,
            'tanggal' => $request->tanggal,
            'foto' => $path, 
        ]);

        return redirect()->back()->with('success', 'Berkas berhasil ditambah.');
    }


    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'acara' => 'required',
            'tanggal' => 'required',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('acara', 'tanggal', 'foto');

        if ($request->hasFile('foto')) {
            if ($agenda->foto && Storage::disk('public')->exists($agenda->foto)) {
                Storage::disk('public')->delete($agenda->foto);
            }

            $data['foto'] = $request->file('foto')->store('agenda', 'public');
        }

        $agenda->update($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        // Hapus file jika ada
        if ($agenda->foto && Storage::disk('public')->exists($agenda->foto)) {
            Storage::disk('public')->delete($agenda->foto);
        }


        // Hapus data dari database
        $agenda->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Data berhasil dihapus.');
    }
}
