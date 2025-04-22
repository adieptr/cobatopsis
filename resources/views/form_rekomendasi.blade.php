<!-- resources/views/form_rekomendasi.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Form Rekomendasi Buku</title>
</head>


<body>
    <h2>Form Rekomendasi Buku</h2>
    <form method="POST" action="{{ route('proses.rekomendasi') }}">
        @csrf

        <!-- Pilih Genre Buku -->
        <label for="genre">Genre Buku: </label>
        <select name="genre" id="genre" required>
            <option value="">Pilih Genre</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->nama_genre }}</option>
            @endforeach
        </select><br><br>

        <!-- Pilih Jenis Buku -->
        <label for="jenis">Jenis Buku: </label>
        <select name="jenis" id="jenis" required>
            <option value="">Pilih Jenis Buku</option>
            <option value="1">Ebook</option>
            <option value="2">Cetak</option>
            <option value="3">Keduanya</option>
        </select><br><br>

        <!-- Pilih Tahun Terbit -->
        <label for="tahun">Tahun Terbit: </label>
        <input type="number" name="tahun" id="tahun" required><br><br>

        <!-- Bobot untuk Genre, Jenis, dan Tahun -->
        <label for="bobot_genre">Bobot Genre: </label>
        <input type="number" name="bobot[]" value="0.4" step="0.1" min="0" max="1"
            required><br><br>

        <label for="bobot_jenis">Bobot Jenis: </label>
        <input type="number" name="bobot[]" value="0.3" step="0.1" min="0" max="1"
            required><br><br>

        <label for="bobot_tahun">Bobot Tahun: </label>
        <input type="number" name="bobot[]" value="0.3" step="0.1" min="0" max="1"
            required><br><br>

        <button type="submit">Proses Rekomendasi</button>
    </form>
</body>

</html>
