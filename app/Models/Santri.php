<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $table = "santris";
    protected $fillable = [
        "nama",
        "nis",
        "jk",
        "no_telp",
        "asrama",
        "kelas",
        "line_id",
        "photo_path",
        "jenjang",
        "remember_token",
        "password",
    ];
}
