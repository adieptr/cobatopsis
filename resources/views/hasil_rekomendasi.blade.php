<pre>
    {{ print_r($hasil, true) }}
</pre>

<!-- resources/views/hasil_rekomendasi.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Hasil Rekomendasi</title>
</head>

<body>
    {{-- <h2>Hasil Rekomendasi Buku</h2>
    <ul>
        @foreach ($hasil as $item)
            <li>{{ $item['buku'] }} — Skor: {{ $item['skor'] }}</li>
        @endforeach
    </ul>
    <a href="{{ route('form.rekomendasi') }}">Kembali ke Form</a> --}}


    <!-- resources/views/hasil_rekomendasi.blade.php -->

<h2>Hasil Rekomendasi</h2>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Buku</th>
            <th>Genre</th>
            <th>Jenis</th>
            <th>Skor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hasil as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['nama'] }}</td>
                <td>{{ $item['genre'] }}</td>
                <td>{{ $item['jenis'] }}</td>
                <td>{{ $item['skor'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


</body>

</html>
