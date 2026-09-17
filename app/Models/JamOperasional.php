<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamOperasional extends Model
{
    use HasFactory;

    protected $table = 'tbl_jam_operasional';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'hari',
        'jam_buka',
        'jam_tutup',
    ];
}
