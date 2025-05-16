<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade\Pdf; // Hapus import PDF facade

class DetailTransaksiController extends Controller
{
    protected $viewPath = 'detail-transaksis'; // Default view path
    protected $routeName = 'detail-transaksis'; // Default route name

    public function setViewPath($path)
    {
        $this->viewPath = $path;
    }

    public function setRouteName($name)
    {
        $this->routeName = $name;
    }

    public function index()
    {
        $detailTransaksis = DetailTransaksi::latest()->paginate(10);
        return view($this->viewPath . '.index', compact('detailTransaksis'));
    }

    public function create()
    {
        $transaksis = Transaksi::all()->pluck('kode_transaksi', 'id');
        $produks = Produk::all()->pluck('nama_produk', 'id');
        return view('detail-transaksis.create', compact('transaksis', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);

        DetailTransaksi::create($request->all());
        return redirect()->route($this->routeName . '.index')->with('success', 'Detail Transaksi berhasil ditambahkan.');
    }

    public function show(DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->load(['transaksi', 'produk']);
        return view('detail-transaksis.show', compact('detailTransaksi'));
    }

    public function edit(DetailTransaksi $detailTransaksi)
    {
        $transaksis = Transaksi::all()->pluck('kode_transaksi', 'id');
        $produks = Produk::all()->pluck('nama_produk', 'id');
        return view('detail-transaksis.edit', compact('detailTransaksi', 'transaksis', 'produks'));
    }

    public function update(Request $request, DetailTransaksi $detailTransaksi)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $detailTransaksi->update($request->all());
        return redirect()->route($this->routeName . '.index')->with('success', 'Detail Transaksi berhasil diupdate.');
    }

    public function destroy(DetailTransaksi $detailTransaksi)
    {
        $detailTransaksi->delete();
        return redirect()->route($this->routeName . '.index')->with('success', 'Detail Transaksi berhasil dihapus.');
    }

    public function indexLaporan()
    {
        $this->setViewPath('laporan'); // Set view path ke folder laporan
        $this->setRouteName('laporan'); // Set route name untuk laporan (sesuai nama folder)
        return $this->index(); // Panggil method index yang sudah dimodifikasi
    }
}
