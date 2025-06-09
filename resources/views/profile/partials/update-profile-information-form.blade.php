<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        {{-- Bagian Name & Email --}}
        <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
            {{-- Name --}}
            <div class="w-full sm:w-1/2">
                <label
                    for="name"
                    class="mb-3 block text-sm font-medium text-black dark:text-white">Name</label>
                <div class="relative">
                    <span class="absolute left-4.5 top-4">
                        <!-- Icon user -->
                        <svg
                            class="fill-current"
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.8">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M3.72039 12.887C4.50179 12.1056 5.5616 11.6666 6.66667 11.6666H13.3333C14.4384 11.6666 15.4982 12.1056 16.2796 12.887C17.061 13.6684 17.5 14.7282 17.5 15.8333V17.5C17.5 17.9602 17.1269 18.3333 16.6667 18.3333C16.2064 18.3333 15.8333 17.9602 15.8333 17.5V15.8333C15.8333 15.1703 15.5699 14.5344 15.1011 14.0655C14.6323 13.5967 13.9964 13.3333 13.3333 13.3333H6.66667C6.00363 13.3333 5.36774 13.5967 4.8989 14.0655C4.43006 14.5344 4.16667 15.1703 4.16667 15.8333V17.5C4.16667 17.9602 3.79357 18.3333 3.33333 18.3333C2.8731 18.3333 2.5 17.9602 2.5 17.5V15.8333C2.5 14.7282 2.93899 13.6684 3.72039 12.887Z"
                                    fill="" />
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M9.99967 3.33329C8.61896 3.33329 7.49967 4.45258 7.49967 5.83329C7.49967 7.214 8.61896 8.33329 9.99967 8.33329C11.3804 8.33329 12.4997 7.214 12.4997 5.83329C12.4997 4.45258 11.3804 3.33329 9.99967 3.33329ZM5.83301 5.83329C5.83301 3.53211 7.69849 1.66663 9.99967 1.66663C12.3009 1.66663 14.1663 3.53211 14.1663 5.83329C14.1663 8.13448 12.3009 9.99996 9.99967 9.99996C7.69849 9.99996 5.83301 8.13448 5.83301 5.83329Z"
                                    fill="" />
                            </g>
                        </svg>
                    </span>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                        placeholder="Your Name"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                        autocomplete="name" />
                </div>
                @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="w-full sm:w-1/2">
                <label
                    for="email"
                    class="mb-3 block text-sm font-medium text-black dark:text-white">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                    placeholder="you@example.com"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username" />
                @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-800 dark:text-white">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center gap-4">
            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-md bg-primary px-6 py-2 text-white font-medium hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

</section>