{{-- user/invitations/create.blade.php --}}
<x-app-layout>
    <main class="p-4">
        <h2 class="mb-4 text-xl font-semibold">Buat Undangan</h2>

        @include('user.invitations._form', [
            'action'     => route('invitations.store'),
            'method'     => 'POST',
            'buttonText' => 'Simpan',
            'themes'     => $themes,
        ])
    </main>
</x-app-layout>
