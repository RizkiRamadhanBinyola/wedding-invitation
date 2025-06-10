<x-app-layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-dark overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @php
                        $user = Auth::user();
                        @endphp
                        Anda login sebagai <strong> {{ $user->role ?? 'User' }}</strong>.
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
</x-app-layout>