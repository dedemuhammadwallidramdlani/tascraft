<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction Management') }}
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
                        <div class="md:mt-0 sm:flex-none w-72">
                            <form action="{{ route('transaksis.index') }}" method="GET">
                                <div class="relative">
                                    <input type="text" name="search" placeholder="Cari Kode Transaksi atau Status"
                                           class="w-full pl-10 pr-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300" />
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M8.5 3a5.5 5.5 0 101.4 10.866l4.684 4.684a1 1 0 001.416-1.413l-4.684-4.684A5.5 5.5 0 008.5 3zm0 1a4.5 4.5 0 11-.001 9.001A4.5 4.5 0 018.5 4z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                            <a href="{{ route('transaksis.create') }}"
                               class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                Tambah Transaksi Baru
                            </a>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-gray-700 uppercase bg-white dark:bg-gray-800">
                            <tr class="bg-white border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="col" class="px-6 py-3 text-center">NO</th>
                                <th scope="col" class="px-6 py-3 text-left">Kode Transaksi</th>
                                <th scope="col" class="px-6 py-3 text-left">Tanggal Transaksi</th>
                                <th scope="col" class="px-6 py-3 text-right">Total Harga</th>
                                <th scope="col" class="px-6 py-3 text-left">Status</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transaksis as $transaksi)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-center">
                                        {{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-2 text-left">{{ $transaksi->kode_transaksi }}</td>
                                    <td class="px-6 py-2 text-left">{{ $transaksi->tanggal_transaksi }}</td>
                                    <td class="px-6 py-2 text-right">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-2 text-left">
                                        <span class="{{ $transaksi->status === 'selesai' ? 'bg-green-100 text-green-800' : ($transaksi->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($transaksi->status === 'dibatalkan' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }} text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-{{ $transaksi->status }}-200 dark:text-{{ $transaksi->status }}-900">{{ ucfirst($transaksi->status) }}</span>
                                    </td>
                                    <td class="px-6 py-2 text-center">
                                        <form onsubmit="return confirm('Apakah anda yakin?');" action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST">
                                            <a href="{{ route('transaksis.show', $transaksi->id) }}"
                                               class="focus:outline-none text-gray-50 bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:focus:ring-blue-900">
                                                Detail
                                            </a>
                                            <a href="{{ route('transaksis.edit', $transaksi->id) }}"
                                               class="focus:outline-none text-gray-50 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                                Edit
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">Tidak ada transaksi ditemukan</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="relative p-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-700 dark:text-gray-300">
                                    Menampilkan {{ $transaksis->firstItem() }} hingga {{ $transaksis->lastItem() }} dari {{ $transaksis->total() }} transaksi
                                </span>
                                {{ $transaksis->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
