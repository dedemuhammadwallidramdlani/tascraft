<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('transaksis.update', $transaksi->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="user_id" :value="__('User')" />
                            <select name="user_id" id="user_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                <option value="" disabled>Pilih User</option>
                                @foreach ($users as $id => $name)
                                    <option value="{{ $id }}" {{ $transaksi->user_id == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="kode_transaksi" :value="__('Kode Transaksi')" />
                            <x-text-input id="kode_transaksi" class="block mt-1 w-full" type="text" name="kode_transaksi"
                                :value="$transaksi->kode_transaksi ?? old('kode_transaksi')" required />
                            <x-input-error :messages="$errors->get('kode_transaksi')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="tanggal_transaksi" :value="__('Tanggal Transaksi')" />
                            <x-text-input id="tanggal_transaksi" class="block mt-1 w-full" type="date" name="tanggal_transaksi"
                                :value="$transaksi->tanggal_transaksi ?? old('tanggal_transaksi')" />
                            <x-input-error :messages="$errors->get('tanggal_transaksi')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="total_harga" :value="__('Total Harga')" />
                            <x-text-input id="total_harga" class="block mt-1 w-full" type="number" name="total_harga"
                                :value="$transaksi->total_harga ?? old('total_harga')" required min="0" step="0.01" />
                            <x-input-error :messages="$errors->get('total_harga')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="dibayar" {{ $transaksi->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                <option value="dikirim" {{ $transaksi->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ $transaksi->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('transaksis.index')">
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
