<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

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
        $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:500',
        ]);

        Partner::create($request->only('name', 'logo_url'));

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
        $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'nullable|url|max:500',
        ]);

        $partner->update($request->only('name', 'logo_url'));

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil diperbarui!');
    }

    // DELETE
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus!');
    }
}