<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(10);
        return view('transaksis.index', compact('transaksis'));
    }

    public function create()
    {
        $users = User::all()->pluck('name', 'id');
        return view('transaksis.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kode_transaksi' => 'required|string|unique:transaksis,kode_transaksi',
            'tanggal_transaksi' => 'nullable|date',
            'total_harga' => 'required|numeric|min:0',
            'status' => 'required|in:pending,dibayar,dikirim,selesai,dibatalkan',
        ]);

        Transaksi::create($request->all());
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('user', 'detailTransaksi.produk');
        return view('transaksis.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        $users = User::all()->pluck('name', 'id');
        return view('transaksis.edit', compact('transaksi', 'users'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kode_transaksi' => 'required|string|unique:transaksis,kode_transaksi,' . $transaksi->id,
            'tanggal_transaksi' => 'nullable|date',
            'total_harga' => 'required|numeric|min:0',
            'status' => 'required|in:pending,dibayar,dikirim,selesai,dibatalkan',
        ]);

        $transaksi->update($request->all());
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}