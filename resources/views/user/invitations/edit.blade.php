{{-- user/invitations/edit.blade.php --}}
<x-app-layout>
    <main class="p-4">
        <h2 class="mb-4 text-xl font-semibold">Edit Undangan</h2>

        @include('user.invitations._form', [
            'action'     => route('invitations.update', $invitation->id),
            'method'     => 'PUT',
            'buttonText' => 'Update',
            'invitation' => $invitation,
            'themes'     => $themes,
        ])
    </main>
</x-app-layout>
