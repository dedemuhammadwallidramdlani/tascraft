<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Detail Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('detail-transaksis.update', $detailTransaksi->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="transaksi_id" :value="__('Transaksi ID')" />
                            <select name="transaksi_id" id="transaksi_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                <option value="" disabled>Pilih Transaksi</option>
                                @foreach ($transaksis as $id => $kode_transaksi)
                                    <option value="{{ $id }}" {{ $detailTransaksi->transaksi_id == $id ? 'selected' : '' }}>
                                        {{ $kode_transaksi }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('transaksi_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="produk_id" :value="__('Produk ID')" />
                            <select name="produk_id" id="produk_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                <option value="" disabled>Pilih Produk</option>
                                @foreach ($produks as $id => $nama_produk)
                                    <option value="{{ $id }}" {{ $detailTransaksi->produk_id == $id ? 'selected' : '' }}>
                                        {{ $nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('produk_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="jumlah" :value="__('Jumlah')" />
                            <x-text-input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah"
                                :value="$detailTransaksi->jumlah ?? old('jumlah')" required min="1" />
                            <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="harga_satuan" :value="__('Harga Satuan')" />
                            <x-text-input id="harga_satuan" class="block mt-1 w-full" type="number" name="harga_satuan"
                                :value="$detailTransaksi->harga_satuan ?? old('harga_satuan')" required min="0" step="0.01" />
                            <x-input-error :messages="$errors->get('harga_satuan')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="subtotal" :value="__('Subtotal')" />
                            <x-text-input id="subtotal" class="block mt-1 w-full" type="number" name="subtotal"
                                :value="$detailTransaksi->subtotal ?? old('subtotal')" required min="0" step="0.01" />
                            <x-input-error :messages="$errors->get('subtotal')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('detail-transaksis.index')">
                                {{ __('Back') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
