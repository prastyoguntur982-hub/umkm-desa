<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    public function index()
    {
        $sosmeds = Sosmed::all();
        return view('admin.sosmed', compact('sosmeds'));
    }

    public function create()
    {
        return view('admin.sosmed.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'instagram' => 'nullable|url',
            'facebook'  => 'nullable|url',
            'youtube'   => 'nullable|url',
            'website'   => 'nullable|url',
            'twitter'   => 'nullable|url',
        ]);

        Sosmed::create($request->all());

        return redirect()->route('admin.sosmed.index')
            ->with('success', 'Data sosmed berhasil ditambahkan.');
    }

    public function edit(Sosmed $sosmed)
    {
        return view('admin.sosmed.edit', compact('sosmed'));
    }

    public function update(Request $request, Sosmed $sosmed)
    {
        $request->validate([
            'instagram' => 'nullable|url',
            'facebook'  => 'nullable|url',
            'youtube'   => 'nullable|url',
            'website'   => 'nullable|url',
            'twitter'   => 'nullable|url',
        ]);

        $sosmed->update($request->all());

        return redirect()->route('admin.sosmed.index')
            ->with('success', 'Data sosmed berhasil diperbarui.');
    }

    public function destroy(Sosmed $sosmed)
    {
        $sosmed->delete();

        return redirect()->route('admin.sosmed')
            ->with('success', 'Data sosmed berhasil dihapus.');
    }
}
