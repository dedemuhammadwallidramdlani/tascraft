<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Detail Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">
                        <!-- <div>
                            <h3 class="text-lg font-semibold dark:text-gray-300">Data Detail Transaksi</h3>
                        </div> -->
                        <div class="flex items-center space-x-2">
                            <!-- <a href="{{ route('laporan.index') }}" target="_blank"
                               class="focus:outline-none text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Print Semua Laporan
                            </a> -->
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-gray-700 uppercase bg-white dark:bg-gray-800">
                            <tr class="bg-white border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="col" class="px-6 py-3 text-center">NO</th>
                                <th scope="col" class="px-6 py-3 text-left">ID Transaksi</th>
                                <th scope="col" class="px-6 py-3 text-left">Nama Produk</th>
                                <th scope="col" class="px-6 py-3 text-center">Jumlah</th>
                                <th scope="col" class="px-6 py-3 text-right">Harga Satuan</th>
                                <th scope="col" class="px-6 py-3 text-righht">Subtotal</th>
                                <!-- <th scope="col" class="px-6 py-3 text-center">Aksi</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($detailTransaksis as $detailTransaksi)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-center">
                                        {{ ($detailTransaksis->currentPage() - 1) * $detailTransaksis->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-2 text-left">{{ $detailTransaksi->transaksi->kode_transaksi ?? '-' }} (ID: {{ $detailTransaksi->transaksi_id }})</td>
                                    <td class="px-6 py-2 text-left">{{ $detailTransaksi->produk->nama_produk ?? '-' }} (ID: {{ $detailTransaksi->produk_id }})</td>
                                    <td class="px-6 py-2 text-center">{{ $detailTransaksi->jumlah }}</td>
                                    <td class="px-6 py-2 text-right">Rp {{ number_format($detailTransaksi->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="px-6 py-2 text-right">Rp {{ number_format($detailTransaksi->subtotal, 0, ',', '.') }}</td>
                                    <td class="px-6 py-2 text-center">
                                        <!-- <a href="{{ route('laporan.index', $detailTransaksi->id) }}" target="_blank"
                                           class="focus:outline-none text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-xs px-3 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                                            Print
                                        </a> -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center">Tidak ada detail transaksi ditemukan</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="relative p-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-700 dark:text-gray-300">
                                    Menampilkan {{ $detailTransaksis->firstItem() }} hingga {{ $detailTransaksis->lastItem() }} dari {{ $detailTransaksis->total() }} detail transaksi
                                </span>
                                {{ $detailTransaksis->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>