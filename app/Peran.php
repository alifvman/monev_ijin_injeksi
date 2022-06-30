<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $table = 'perans';
    protected $fillable = [
        'posisi', 'nama'
    ];
}
