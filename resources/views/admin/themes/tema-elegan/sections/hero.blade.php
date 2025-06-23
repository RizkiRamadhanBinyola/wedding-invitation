<section class="text-center my-12">
    <h1 class="text-4xl font-bold">{{ $invitation->nama_pria ?? '-' }} &amp; {{ $invitation->nama_wanita ?? '-' }}</h1>
    <p class="mt-2 text-lg text-gray-600">
        {{ optional($invitation->tanggal ?? null)->format('d M Y') }}
    </p>
</section>