# spk_buku.py
import sys
import json
import numpy as np
import pandas as pd

def topsis(data, weights):
    norm_data = data / np.sqrt((data ** 2).sum())
    weighted = norm_data * weights
    ideal_pos = weighted.max(axis=0)
    ideal_neg = weighted.min(axis=0)
    dist_pos = np.sqrt(((weighted - ideal_pos) ** 2).sum(axis=1))
    dist_neg = np.sqrt(((weighted - ideal_neg) ** 2).sum(axis=1))
    score = dist_neg / (dist_pos + dist_neg)
    return score

if __name__ == "__main__":
    # ✅ Gunakan stdin lagi seperti awal
    input_data = sys.stdin.read()
    args = json.loads(input_data)

    alternatif = args['alternatif']
    matriks = np.array(args['matriks'], dtype=float)
    bobot = np.array(args['bobot'], dtype=float)

    hasil = topsis(pd.DataFrame(matriks), bobot)

    hasil_final = sorted(
        [{"buku": nama, "skor": round(float(skor), 4)} for nama, skor in zip(alternatif, hasil)],
        key=lambda x: x['skor'],
        reverse=True
    )

    print(json.dumps(hasil_final))
