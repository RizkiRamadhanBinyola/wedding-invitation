<!-- resources/views/user/setup-invitation.blade.php -->
@php($title = 'Setup Undangan Pertama')
<!DOCTYPE html>
<html lang="en">

<x-header :title="$title"></x-header>


<body>
    @section('title', 'Daftar Undangan')
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent">
        </div>
    </div>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Setup Undangan Pertama
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('user.invitation.setup.submit') }}">
                    @csrf

                    <!-- Judul Undangan (slug) -->
                    <div class="mb-4">
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-white">Slug Undangan</label>
                        <input type="text" name="slug" id="slug" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="misal: undangan-raka-laras">
                        <p class="text-xs text-gray-500 dark:text-gray-300">Slug ini akan menjadi alamat URL undangan Anda, misal: https://domain.com/<strong>undangan-raka-laras</strong></p>
                    </div>

                    <!-- Judul/Nama Undangan -->
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-white">Nama Pengantin</label>
                        <input type="text" name="judul" id="judul" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="misal: Raka & Laras">
                    </div>

                    <!-- Paket Undangan -->
                    <!-- Paket Undangan -->
                    <div class="mb-4">
                        <label for="package_id" class="block text-sm font-medium text-gray-700 dark:text-white">Paket Undangan</label>
                        <select name="package_id" id="package_id" required
                            class="mt-1 block w-full rounded-md ...">
                            @foreach ($packages as $package)
                            <option value="{{ $package->id }}">
                                {{ $package->name }} - Rp{{ number_format($package->price) }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Pilih Tema -->
                    <div class="mb-4">
                        <label for="theme_id" class="block text-sm font-medium text-gray-700 dark:text-white">Pilih Tema</label>
                        <select name="theme_id" id="theme_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach ($themes as $theme)
                            <option value="{{ $theme->id }}">{{ ucfirst($theme->name) }} ({{ $theme->kategori }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Lanjutkan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- ===== Page Wrapper End ===== -->
    <script defer src="{{ asset('tailadmin/build/bundle.js') }}"></script>
</body>

</html>