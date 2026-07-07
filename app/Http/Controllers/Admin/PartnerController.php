<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    // READ + SEARCH
    public function index(Request $request)
    {
        $search = $request->input('search');

        $partners = Partner::when($search, function ($query, $search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('admin.partners.index', compact('partners', 'search'));
    }

    // CREATE
    public function create()
    {
        return view('admin.partners.create');
    }

    // STORE
    public function store(Request $request)
    {
        // Validasi input: sekarang kita validasi 'logo' sebagai file gambar
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048', 
        ]);

        // Siapkan array data untuk disimpan
        $data = [
            'name' => $request->name,
        ];

        // Jika ada file yang di-upload, simpan ke storage dan masukkan path-nya ke 'logo_url'
        if ($request->hasFile('logo')) {
            $data['logo_url'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan!');
    }

    // EDIT
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    // UPDATE
    public function update(Request $request, Partner $partner)
    {
        // Validasi input: logo boleh kosong (nullable) jika tidak ingin ganti gambar
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
        ];

        // Jika user meng-upload gambar baru
        if ($request->hasFile('logo')) {
            // Hapus gambar lama dari server (jika ada) agar tidak menumpuk
            if ($partner->logo_url && Storage::disk('public')->exists($partner->logo_url)) {
                Storage::disk('public')->delete($partner->logo_url);
            }
            
            // Simpan gambar baru
            $data['logo_url'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil diperbarui!');
    }

    // DELETE
    public function destroy(Partner $partner)
    {
        // Hapus file gambar dari server sebelum data di database dihapus
        if ($partner->logo_url && Storage::disk('public')->exists($partner->logo_url)) {
            Storage::disk('public')->delete($partner->logo_url);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus!');
    }
}