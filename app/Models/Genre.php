<?php

// app/Models/Genre.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres'; // nama tabel untuk genre

    protected $fillable = ['nama'];
}
