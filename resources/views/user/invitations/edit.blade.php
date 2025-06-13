{{-- edit.blade.php --}}
@include('user.invitations.form', [
    'action' => route('invitations.update', $invitation->id),
    'method' => 'PUT',
    'buttonText' => 'Update',
    'themes' => $themes,
    'data' => $invitation,
])
