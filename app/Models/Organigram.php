<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organigram extends Model
{
    use HasFactory;

    protected $table = 'tbl_organigram';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'jabatan',
        'foto'
    ];
}