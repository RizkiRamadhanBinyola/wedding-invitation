<x-app-layout>
    <main class="p-3">
        <div class="max-w-4xl mx-auto p-6 bg-dark rounded shadow">
            <h1 class="text-2xl font-semibold mb-4">Edit User</h1>

            {{-- tampilkan error validasi --}}
            @if ($errors->any())
                <div class="mb-4 rounded bg-red-100 px-4 py-3 text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user) }}" method="POST" class="flex flex-col gap-5.5">
                @csrf
                @method('PUT')

                @include('admin.users._form', [
                    'user'   => $user,
                    'method' => 'PUT',
                    'button' => 'Update'
                ])
            </form>
        </div>
    </main>
</x-app-layout>
