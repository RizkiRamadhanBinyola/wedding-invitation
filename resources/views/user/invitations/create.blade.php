{{-- create.blade.php --}}
@include('user.invitations.form', [
    'action' => route('invitations.store'),
    'method' => 'POST',
    'buttonText' => 'Simpan',
    'themes' => $themes,
    'data' => null,
])
