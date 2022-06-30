<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = 'arsips';
    protected $fillable = [
        'permohonan_id', 'jenis',
        'f1nama', 'f1jabatan', 'f1alamat', 'f1kelurahan', 'f1kecamatan', 'f1kota', 'f1provinsi', 'f1kodepos', 'f1telp', 'f1faks', 'f1email',
        'f2nama', 'f2alamat', 'f2kelurahan', 'f2kecamatan', 'f2kota', 'f2provinsi', 'f2kodepos', 'f2telp', 'f2faks', 'f2email',
        'f2kegiatan', 'f2akta', 'f2npp', 'f2npwp', 'f2produksi', 'f2kapasitas', 'f2kontak',
        'f2alamatkegiatan', 'f2kelurahankegiatan', 'f2kecamatankegiatan', 'f2kotakegiatan', 'f2provinsikegiatan', 'f2kodeposkegiatan', 'f2flag',
        'f3nama', 'f3jabatan', 'f3alamat', 'f3kelurahan', 'f3kecamatan', 'f3kota', 'f3provinsi', 'f3kodepos', 'f3telp', 'f3faks', 'f3email'
    ];
}
