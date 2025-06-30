<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">

    @php
    $user = Auth::user();
    $role = $user->role ?? 'user';
    @endphp

    <!-- ========== HEADER ========== -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="{{ route('dashboard') }}">
            Dashboard {{ ucfirst($role) }}
        </a>
        <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z" />
            </svg>
        </button>
    </div>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MENU ========== -->
    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <nav class="mt-5 px-4 py-4 lg:mt-9 lg:px-6" x-data="{ selected: $persist('Dashboard') }">
            <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU</h3>

            <ul class="mb-6 flex flex-col gap-1.5">

                <!-- Dashboard umum -->
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="group flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium
                  {{ request()->routeIs('dashboard') ? 'bg-graydark dark:bg-meta-4' : 'hover:bg-graydark dark:hover:bg-meta-4' }}">
                        <i class="fa-solid fa-house"></i> Dashboard
                    </a>
                </li>

                {{-- ========================= MENU KHUSUS ADMIN ========================= --}}
                @if ($role === 'admin')
                {{-- ---------- UNDANGAN (ADMIN) ---------- --}}
                <li x-data="{ open: {{ request()->routeIs('invitations.*') ? 'true' : 'false' }} }">
                    <a href="#" @click.prevent="open = !open"
                        class="group flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium
                      hover:bg-graydark dark:hover:bg-meta-4"
                        :class="{ 'bg-graydark dark:bg-meta-4': open }">
                        <i class="fa-solid fa-envelope-open-text w-4"></i>
                        Undangan
                        <svg class="ml-auto w-4 transition-transform" :class="{ 'rotate-180': open }"
                            viewBox="0 0 20 20">
                            <path fill="currentColor"
                                d="M4.41 6.91a1 1 0 0 1 1.18 0L10 11.32l4.41-4.41a1 1 0 1 1 1.18 1.18l-5 5a1 1 0 0 1-1.18 0l-5-5a1 1 0 0 1 0-1.18z" />
                        </svg>
                    </a>
                    <div x-show="open" class="mt-4 pl-6">
                        <ul class="flex flex-col gap-2.5">
                            <li>
                                <a href="{{ route('invitations.index') }}"
                                    class="flex items-center gap-2 px-2 py-1
                                  {{ request()->routeIs('invitations.index') ? 'text-primary' : 'hover:text-white' }}">
                                    <i class="fa-solid fa-list w-4"></i> Semua Undangan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('invitations.create') }}"
                                    class="flex items-center gap-2 px-2 py-1
                                  {{ request()->routeIs('invitations.create') ? 'text-primary' : 'hover:text-white' }}">
                                    <i class="fa-solid fa-plus w-4"></i> Buat Undangan
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- ---------- TEMA ---------- --}}
                <li x-data="{ open: {{ request()->routeIs('themes.*') ? 'true' : 'false' }} }">
                    <a href="#" @click.prevent="open = !open"
                        class="group flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium
                      hover:bg-graydark dark:hover:bg-meta-4"
                        :class="{ 'bg-graydark dark:bg-meta-4': open }">
                        <i class="fa-solid fa-palette w-4"></i>
                        Tema
                        <svg class="ml-auto w-4 transition-transform" :class="{ 'rotate-180': open }"
                            viewBox="0 0 20 20">
                            <path fill="currentColor"
                                d="M4.41 6.91a1 1 0 0 1 1.18 0L10 11.32l4.41-4.41a1 1 0 1 1 1.18 1.18l-5 5a1 1 0 0 1-1.18 0l-5-5a1 1 0 0 1 0-1.18z" />
                        </svg>
                    </a>
                    <div x-show="open" class="mt-4 pl-6">
                        <ul class="flex flex-col gap-2.5">
                            <li>
                                <a href="{{ route('themes.index') }}"
                                    class="flex items-center gap-2 px-2 py-1
                                  {{ request()->routeIs('themes.index') ? 'text-primary' : 'hover:text-white' }}">
                                    <i class="fa-solid fa-list w-4"></i> List Tema
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('themes.create') }}"
                                    class="flex items-center gap-2 px-2 py-1
                                  {{ request()->routeIs('themes.create') ? 'text-primary' : 'hover:text-white' }}">
                                    <i class="fa-solid fa-plus w-4"></i> Buat Tema
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- ---------- PENGGUNA ---------- --}}
                <li>
                    <a href="{{ route('users.index') }}"
                        class="group flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium
                      hover:bg-graydark dark:hover:bg-meta-4
                      {{ request()->routeIs('users.*') ? 'bg-graydark dark:bg-meta-4' : '' }}">
                        <i class="fa-solid fa-users-cog"></i> Pengguna
                    </a>
                </li>
                @endif

                {{-- ========================= MENU KHUSUS USER ========================= --}}
                @if ($role === 'user')

                <li>
                    <a href="{{ route('invitations.index') }}"
                        class="group flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium
                                {{ request()->routeIs('invitations.index') ? 'bg-graydark dark:bg-meta-4' : 'hover:bg-graydark dark:hover:bg-meta-4' }}">
                        <i class="fa-solid fa-envelope"></i> Lihat Undangan
                    </a>
                </li>
                @endif

                <!-- UCAPAN & DOA -->
                <li>
                    <a href="/ucapan"
                        class="group flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium
                  hover:bg-graydark dark:hover:bg-meta-4
                  {{ request()->is('ucapan') ? 'bg-graydark dark:bg-meta-4' : '' }}">
                        <i class="fa-solid fa-comment-dots"></i> Ucapan & Doa
                    </a>
                </li>

            </ul>

        </nav>
    </div>
</aside>