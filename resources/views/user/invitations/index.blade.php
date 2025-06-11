<h2>Daftar Undangan Kamu</h2>

<a href="{{ route('user.invitations.create') }}">+ Buat Undangan</a>

<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Tema</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invitations as $item)
            <tr>
                <td>{{ $item->nama_pria }} & {{ $item->nama_wanita }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->theme->name }}</td>
                <td>
                    <a href="{{ route('user.invitations.edit', $item->id) }}">Edit</a>
                    <a href="/invitation/{{ $item->slug }}" target="_blank">Lihat</a>
                    <form method="POST" action="{{ route('user.invitations.destroy', $item->id) }}" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
