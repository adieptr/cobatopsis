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
        $command = escapeshellcmd("python \"$pythonPath\" '" . addslashes($payload) . "'");
        $output = shell_exec($command);
        $hasil = json_decode($output, true);

        return view('hasil_rekomendasi', ['hasil' => $hasil]);
    }
}
