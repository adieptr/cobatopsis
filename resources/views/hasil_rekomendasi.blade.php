<!-- resources/views/hasil_rekomendasi.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Hasil Rekomendasi</title>
</head>

<body>
    <h2>Hasil Rekomendasi Buku</h2>
    <ul>
        @foreach ($hasil as $item)
            <li>{{ $item['buku'] }} — Skor: {{ $item['skor'] }}</li>
        @endforeach
    </ul>
    <a href="{{ route('form.rekomendasi') }}">Kembali ke Form</a>
</body>

</html>
