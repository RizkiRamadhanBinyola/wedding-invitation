{{-- admin/invitations/create.blade.php --}}
<x-app-layout>
    <main class="p-4">
        <h2 class="mb-4 text-xl font-semibold">Tambah Undangan</h2>

        @include('admin.invitations._form', [
            'action'     => route('invitations.store'),
            'method'     => 'POST',
            'buttonText' => 'Simpan',
            'themes'     => $themes,
            'users'      => $users,
        ])
    </main>
</x-app-layout>
