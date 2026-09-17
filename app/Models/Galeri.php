<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'tbl_galeri';
    protected $primaryKey = 'id';
    public $timestamps = false; // Karena tabel tidak memiliki created_at & updated_at

    protected $fillable = [
        'gambar',
        'keterangan'
    ];
}