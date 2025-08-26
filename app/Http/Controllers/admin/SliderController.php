<?php

namespace App\Http\Controllers\admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    public function index()
    {
        $slider = Slider::all();

        return view('admin.slider', compact('slider'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('foto')->store('slider', 'public');

        Slider::create(['foto' => $path]);

        return back()->with('success', 'Slider berhasil ditambahkan.');
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus file lama
            if (Storage::disk('public')->exists($slider->foto)) {
                Storage::disk('public')->delete($slider->foto);
            }

            $path = $request->file('foto')->store('slider', 'public');
            $slider->update(['foto' => $path]);
        }

        return back()->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy(Slider $slider)
    {
        // Hapus file foto dari storage
        if (Storage::disk('public')->exists($slider->foto)) {
            Storage::disk('public')->delete($slider->foto);
        }

        $slider->delete();

        return back()->with('success', 'Slider berhasil dihapus.');
    }
}
