<section class="my-12">
    <h2 class="text-2xl font-semibold mb-4">Detail Acara</h2>
    <ul class="list-disc pl-5 space-y-1">
        <li><strong>Akad :</strong> {{ $invitation->waktu_akad ?? '-' }}</li>
        <li><strong>Resepsi :</strong> {{ $invitation->waktu_resepsi ?? '-' }}</li>
        <li><strong>Lokasi :</strong> {{ $invitation->lokasi ?? '-' }}</li>
    </ul>
</section>