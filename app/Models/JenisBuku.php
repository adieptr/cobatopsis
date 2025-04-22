<?php

// app/Models/JenisBuku.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBuku extends Model
{
    protected $table = 'jenis_buku'; // nama tabel untuk jenis buku

    protected $fillable = ['nama'];
}

