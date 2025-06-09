<section class="py-2">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
        <div class="w-full sm:w-1/3">
            <label for="update_password_current_password"
                class="mb-3 block text-sm font-medium text-black dark:text-white">
                {{ __('Current Password') }}
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
            />
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full sm:w-1/3">
            <label for="update_password_password"
                class="mb-3 block text-sm font-medium text-black dark:text-white">
                {{ __('New Password') }}
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
            />
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full sm:w-1/3">
            <label for="update_password_password_confirmation"
                class="mb-3 block text-sm font-medium text-black dark:text-white">
                {{ __('Confirm Password') }}
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
            />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex items-center gap-4">
        <button type="submit"
            class="inline-flex items-center justify-center rounded bg-primary px-6 py-2 text-center text-base font-medium text-white hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
            {{ __('Save') }}
        </button>

        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-success"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>

</section>
