<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\JenisBuku;
use App\Models\Buku;
use Illuminate\Support\Facades\Log;

class SpkBukuController extends Controller
{
    public function form()
    {
        $genres = Genre::all();
        $jenisBuku = JenisBuku::all();
        return view('form_rekomendasi', compact('genres', 'jenisBuku'));
    }

    public function proses(Request $request)
    {
        $genre = $request->input('genre');
        $jenis = $request->input('jenis');
        $tahun = $request->input('tahun');
        $bobot = $request->input('bobot');

        Log::debug('Input User:', compact('genre', 'jenis', 'tahun', 'bobot'));

        $bukus = Buku::where('genre', $genre)
                    ->where('jenis', $jenis)
                    ->where('tahun', '>=', $tahun)
                    ->get();

        Log::debug('Data Buku:', $bukus->toArray());

        if ($bukus->isEmpty()) {
            return view('hasil_rekomendasi', ['hasil' => []])
                   ->with('message', 'Tidak ada buku yang cocok dengan kriteria.');
        }

        $alternatif = $bukus->pluck('nama')->toArray();
        $matriks = $bukus->map(function ($buku) {
            return [
                (int) $buku->genre,
                (int) $buku->jenis,
                (int) $buku->tahun,
            ];
        })->toArray();

        Log::debug('Alternatif:', $alternatif);
        Log::debug('Matriks:', $matriks);

        $payload = json_encode([
            'alternatif' => $alternatif,
            'matriks' => $matriks,
            'bobot' => $bobot
        ]);

        Log::debug('Payload JSON:', [$payload]);

        $pythonPath = base_path('python/spk_buku.py');
        $pythonExe = 'python';

        $process = proc_open(
            "\"$pythonExe\" \"$pythonPath\"",
            [
                0 => ['pipe', 'r'],
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ],
            $pipes
        );

        if (is_resource($process)) {
            fwrite($pipes[0], $payload);
            fclose($pipes[0]);

            $output = stream_get_contents($pipes[1]);
            $error = stream_get_contents($pipes[2]);

            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);

            Log::debug('Python Output:', [$output]);
            Log::debug('Python Error:', [$error]);

            if (!empty($error)) {
                return response()->json(['error' => $error], 500);
            }

            $hasil = json_decode($output, true);
            $hasil = json_decode($output, true);
            if (empty($hasil)) {
                return back()->with('error', 'Rekomendasi tidak dapat dihitung. Minimal 2 buku diperlukan.');
            }

            Log::debug('Hasil Setelah Decode:', $hasil);

            if (!is_array($hasil)) {
                return view('hasil_rekomendasi', ['hasil' => []])
                       ->with('message', 'Format hasil tidak valid.');
            }

            foreach ($hasil as &$item) {
                $buku = Buku::find($item['buku_id']);
                $item['genre'] = optional($buku->genreBuku)->nama ?? '-';
                $item['jenis'] = optional($buku->jenisBuku)->nama ?? '-';
            }

            return view('hasil_rekomendasi', ['hasil' => $hasil]);
        }

        return view('hasil_rekomendasi', ['hasil' => []])
               ->with('message', 'Gagal menjalankan Python.');
    }
}
