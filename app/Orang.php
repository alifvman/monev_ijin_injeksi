<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orang extends Model
{
    protected $table = 'orangs';
    protected $fillable = [
        'nama', 'jabatan', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kodepos', 'telp', 'faks', 'email', 'flag'
    ];
}
