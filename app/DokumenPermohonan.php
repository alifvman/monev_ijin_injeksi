<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenPermohonan extends Model
{
    protected $table = 'dokumen_permohonans';
    protected $fillable = [
        'permohonan_id', 'dokumen_id', 'filename', 'ext', 'mime', 'pathname', 'flag'
    ];

    public function permohonan() {
        return $this->hasOne('App\Permohonan', 'id', 'permohonan_id');
    }

    public function dokumen() {
        return $this->hasOne('App\Dokumen', 'id', 'dokumen_id');
    }
}
