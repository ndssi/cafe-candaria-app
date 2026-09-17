<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    // FIX: nama tabel sebelumnya 'profils', padahal migration membuat 'tbl_profil'
    protected $table = 'tbl_profil';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
    ];

    // View memakai $profil->sejarah, sedangkan kolom di DB bernama 'isi'.
    // Accessor/mutator ini menjembatani supaya keduanya tetap sinkron.
    public function getSejarahAttribute()
    {
        return $this->isi;
    }

    public function setSejarahAttribute($value)
    {
        $this->attributes['isi'] = $value;
    }
}
