<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaans';
    protected $fillable = [
        'nama', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kodepos', 'telp', 'faks', 'email',
        'kegiatan', 'akta', 'npp', 'npwp', 'produksi', 'kapasitas', 'kontak',
        'alamatkegiatan', 'kelurahankegiatan', 'kecamatankegiatan', 'kotakegiatan', 'provinsikegiatan', 'kodeposkegiatan', 'flag'
    ];
}
