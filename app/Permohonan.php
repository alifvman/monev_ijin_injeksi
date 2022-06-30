<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $table = 'permohonans';
    protected $fillable = [
        'nama', 'ref_f1_pemohon', 'ref_f2_perusahaan', 'ref_f3_pengurus', 'jenis', 'stage', 'flag'
    ];

    public function trackings()
    {
        return $this->hasMany('App\Tracking');
    }
}
