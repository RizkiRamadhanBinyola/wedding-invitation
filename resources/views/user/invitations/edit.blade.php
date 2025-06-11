{{-- edit.blade.php --}}
<h2>Edit Undangan</h2>
@include('user.invitations.form', [
    'action' => route('user.invitations.update', $invitation->id),
    'method' => 'PUT',
    'buttonText' => 'Update',
    'themes' => $themes,
    'data' => $invitation,
])
