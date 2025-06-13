<div>
    <label class="mb-3 block text-sm font-medium">Nama</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="w-full rounded-lg border px-5 py-3" required>
</div>

<div>
    <label class="mb-3 block text-sm font-medium">Email</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="w-full rounded-lg border px-5 py-3" required>
</div>

@if($method === 'POST')
    <div>
        <label class="mb-3 block text-sm font-medium">Password</label>
        <input type="password" name="password" class="w-full rounded-lg border px-5 py-3" required>
    </div>

    <div>
        <label class="mb-3 block text-sm font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="w-full rounded-lg border px-5 py-3" required>
    </div>
@endif


<div>
    <label class="mb-3 block text-sm font-medium">Role</label>
    <select name="role" class="w-full rounded-lg border px-5 py-3" required>
        <option value="user" {{ old('role', $user->role ?? '') === 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
</div>

<div>
    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded">{{ $button }}</button>
</div>
