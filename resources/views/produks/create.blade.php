<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('produks.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="nama_produk" :value="__('Nama Produk')" />
                            <x-text-input id="nama_produk" class="block mt-1 w-full" type="text" name="nama_produk"
                                :value="old('nama_produk')" required autofocus />
                            <x-input-error :messages="$errors->get('nama_produk')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" name="deskripsi">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="harga" :value="__('Harga')" />
                            <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga"
                                :value="old('harga')" required min="0" step="0.01" />
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="stok" :value="__('Stok')" />
                            <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok"
                                :value="old('stok')" required min="0" />
                            <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                        </div>

                        <!-- <div class="mt-4">
                            <x-input-label for="gambar" :value="__('Gambar')" />
                            <x-text-input id="gambar" class="block mt-1 w-full" type="file" name="gambar"
                                :value="old('gambar')" />
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div> -->

                        <div class="mt-4">
                            <x-input-label for="category" :value="__('Kategori')" />
                            <x-text-input id="category" class="block mt-1 w-full" type="text" name="category"
                                :value="old('category')" />
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('produks.index')">
                                {{ __('Back') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
