<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumens';
    protected $fillable = [
        'grup', 'nama', 'deskripsi'
    ];
}
