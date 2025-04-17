<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpkBukuController extends Controller
{
    public function form()
    {
        return view('form_rekomendasi');
    }

    public function proses(Request $request)
    {
        $alternatif = $request->input('alternatif');
        $matriks = $request->input('matriks');
        $bobot = $request->input('bobot');

        $payload = json_encode([
            'alternatif' => $alternatif,
            'matriks' => $matriks,
            'bobot' => $bobot
        ]);

        $pythonPath = base_path('python/spk_buku.py');
        $pythonExe = 'C:\\Users\\user\\AppData\\Local\\Programs\\Python\\Python311\\python.exe';

        $process = proc_open(
            "\"$pythonExe\" \"$pythonPath\"",
            [
                0 => ['pipe', 'r'], // stdin
                1 => ['pipe', 'w'], // stdout
                2 => ['pipe', 'w'], // stderr
            ],
            $pipes
        );

        if (is_resource($process)) {
            fwrite($pipes[0], $payload); // kirim JSON ke stdin
            fclose($pipes[0]);

            $output = stream_get_contents($pipes[1]);
            $error = stream_get_contents($pipes[2]);

            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);

            if (!empty($error)) {
                dd("Python error:", $error); // tampilkan error dari Python
            }

            $hasil = json_decode($output, true);
            if (!is_array($hasil)) {
                $hasil = [];
            }

            return view('hasil_rekomendasi', ['hasil' => $hasil]);
        }

        // Fallback kalau process gagal
        return view('hasil_rekomendasi', ['hasil' => []]);
    }
}
