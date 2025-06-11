{{-- create.blade.php --}}
<h2>Buat Undangan</h2>
@include('user.invitations.form', [
    'action' => route('user.invitations.store'),
    'method' => 'POST',
    'buttonText' => 'Simpan',
    'themes' => $themes,
    'data' => null,
])
