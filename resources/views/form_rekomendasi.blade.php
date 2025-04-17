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

        <label>Nama Buku A: </label>
        <input type="text" name="alternatif[]" value="Buku A" required><br>

        <label>Genre (0/1): </label>
        <input type="number" name="matriks[0][]" required><br>

        <label>Jenis (1 = ebook, 2 = cetak, 3 = keduanya): </label>
        <input type="number" name="matriks[0][]" required><br>

        <label>Tahun Terbit: </label>
        <input type="number" name="matriks[0][]" required><br><br>

        <!-- Ulangi untuk Buku B -->
        <label>Nama Buku B: </label>
        <input type="text" name="alternatif[]" value="Buku B" required><br>

        <label>Genre: </label>
        <input type="number" name="matriks[1][]" required><br>
        <label>Jenis: </label>
        <input type="number" name="matriks[1][]" required><br>
        <label>Tahun Terbit: </label>
        <input type="number" name="matriks[1][]" required><br><br>

        <!-- Ulangi untuk Buku C -->
        <label>Nama Buku C: </label>
        <input type="text" name="alternatif[]" value="Buku C" required><br>

        <label>Genre: </label>
        <input type="number" name="matriks[2][]" required><br>
        <label>Jenis: </label>
        <input type="number" name="matriks[2][]" required><br>
        <label>Tahun Terbit: </label>
        <input type="number" name="matriks[2][]" required><br><br>

        <!-- Bobot -->
        <label>Bobot Genre: </label>
        <input type="text" name="bobot[]" value="0.4" required><br>
        <label>Bobot Jenis: </label>
        <input type="text" name="bobot[]" value="0.3" required><br>
        <label>Bobot Tahun: </label>
        <input type="text" name="bobot[]" value="0.3" required><br><br>

        <button type="submit">Proses Rekomendasi</button>
    </form>
</body>

</html>
