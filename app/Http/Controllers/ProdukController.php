<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        // Menampilkan produk dengan pagination
        $produks = Produk::latest()->paginate(10);
        return view('produks.index', compact('produks'));
    }

    public function create()
    {
        return view('produks.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
        ]);

        // Menyimpan produk tanpa gambar
        $produk = Produk::create($request->except('gambar'));

        // Menyimpan gambar jika ada
        if ($request->hasFile('gambar')) {
            // Simpan gambar di storage public
            $path = $request->file('gambar')->store('produks', 'public');
            $produk->gambar = basename($path); // Simpan hanya nama file
            $produk->save();
        }

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        return view('produks.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produks.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
        ]);

        // Update data produk tanpa gambar
        $produk->update($request->except('gambar'));

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar) {
                Storage::disk('public')->delete('produks/' . $produk->gambar);
            }

            // Simpan gambar baru
            $path = $request->file('gambar')->store('produks', 'public');
            $produk->gambar = basename($path); // Simpan hanya nama file
            $produk->save();
        }

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Produk $produk)
    {
        // Hapus gambar jika ada
        if ($produk->gambar) {
            Storage::disk('public')->delete('produks/' . $produk->gambar);
        }

        // Hapus produk dari database
        $produk->delete();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }
}
