<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ////////// MASTER DATA //////////

        App\Peran::create(array('posisi' => 'PMH', 'nama' => 'Pemohon'));
        App\Peran::create(array('posisi' => 'PTS', 'nama' => 'PTSP'));
        App\Peran::create(array('posisi' => 'TUS', 'nama' => 'Tata Usaha'));
        App\Peran::create(array('posisi' => 'PJM', 'nama' => 'Penanggung Jawab Materi'));
        App\Peran::create(array('posisi' => 'KSD', 'nama' => 'Kasubdit'));
        App\Peran::create(array('posisi' => 'DIR', 'nama' => 'Direktur PPA'));
        App\Peran::create(array('posisi' => 'SES', 'nama' => 'Sesdit'));
        App\Peran::create(array('posisi' => 'DRJ', 'nama' => 'Dirjen'));
        App\Peran::create(array('posisi' => 'RKM', 'nama' => 'Biro Hukum'));

        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Akte Perusahaan dan Perubahan Terakhir'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Nomor Pokok Wajib Pajak (NPWP)'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'SIUP/IUI/IUT/SIUPAL'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Tanda Daftar Perusahaan (TDP)'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Angka Pengenal Impor (API)'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Nomor Induk Kepabeanan (NIK)'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Surat Keterangan Domisili'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Surat Kuasa Pendelegasian'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Pakta Integritas'));
        App\Dokumen::create(array('grup' => 'A*', 'nama' => 'Surat Permohonan'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Surat Izin Lingkungan'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Dokumen Lingkungan'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Data sumber air limbah yang akan diinjeksikan ke sumur injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Lokasi dan Situasi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Zona target injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Kedalaman target injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Volume/kapasitas tampung zone injeksi dan perkiraan sebaran air limbah di zona injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Sifat batuan zona target injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Sifat fluida (air limbah yang akan diinjeksi dan air yang ada di zona injeksi)'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Seal (Batuan penutup)'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Konfigurasi bawah permukaan'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Tekanan dan suhu zona target injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Data sumur injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Desain sumur injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Bahaya bawah permukaan'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Rencana pemantauan sumur'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Rencana penutupan sumur injeksi'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Tanggap darurat'));
        App\Dokumen::create(array('grup' => 'TB', 'nama' => 'Kajian sumur yang tidak ditutup atau ditinggalkan secara tidak sempurna yang berada di dalam Daerah kajian injeksi'));
        App\Dokumen::create(array('grup' => 'TU', 'nama' => 'Surat Izin Lingkungan'));
        App\Dokumen::create(array('grup' => 'TU', 'nama' => 'Dokumen Lingkungan'));
        App\Dokumen::create(array('grup' => 'TU', 'nama' => 'Informasi Perubahan'));
        App\Dokumen::create(array('grup' => 'TU', 'nama' => 'Data Kegiatan'));
        App\Dokumen::create(array('grup' => 'TP', 'nama' => 'Kegiatan Injeksi'));
        App\Dokumen::create(array('grup' => 'TP', 'nama' => 'Kepala Sumur'));
        App\Dokumen::create(array('grup' => 'TP', 'nama' => 'Debit, Volume dan Tekanan Injeksi'));
        App\Dokumen::create(array('grup' => 'TP', 'nama' => 'Kinerja Sumur Injeksi'));
        App\Dokumen::create(array('grup' => 'TP', 'nama' => 'Pemantauan Air Tanah (onshore)'));

        App\StageHandler::create(array('stage' => 1, 'next' => 3, 'reroute' => 2, 'posisi' => 'PTS', 'nama' => 'Pemeriksaan Kelengkapan Dokumen',                                              'bread' => 'PTSP',               'next_label' => 'Dokumen Lengkap',                              'reroute_label' => 'Ada Kekurangan Dokumen'));
        App\StageHandler::create(array('stage' => 2, 'next' =>-2, 'reroute' => 0, 'posisi' => 'TUS', 'nama' => 'Korespondensi Surat Kekurangan Dokumen',                                       'bread' => 'T.U',                'next_label' => 'Korespondensi Selesai'));
        App\StageHandler::create(array('stage' => 3, 'next' => 4, 'reroute' => 0, 'posisi' => 'DIR', 'nama' => 'Disposisi Direktur PPA',                                                       'bread' => 'DIR',                'next_label' => 'Disposisi OK'));
        App\StageHandler::create(array('stage' => 4, 'next' => 5, 'reroute' => 0, 'posisi' => 'PJM', 'nama' => 'Pemeriksaan Materi',                                                           'bread' => 'PJM',                'next_label' => 'Pemeriksaan Selesai'));
        App\StageHandler::create(array('stage' => 5, 'next' => 6, 'reroute' => 0, 'posisi' => 'KSD', 'nama' => 'Disposisi Kasubdit',                                                           'bread' => 'KSD',                'next_label' => 'Disposisi OK'));
        App\StageHandler::create(array('stage' => 6, 'next' => 8, 'reroute' => 7, 'posisi' => 'TUS', 'nama' => 'Rapat Perizinan',                                                              'bread' => 'Rapat',              'next_label' => 'Rapat Selesai',                                'reroute_label' => 'Korespondensi Perbaikan'));
        App\StageHandler::create(array('stage' => 7, 'next' => 8, 'reroute' => 0, 'posisi' => 'TUS', 'nama' => 'Korespondensi Surat Perbaikan',                                                'bread' => 'T.U',                'next_label' => 'Korespondensi Selesai'));
        App\StageHandler::create(array('stage' => 8, 'next' => 9, 'reroute' => 0, 'posisi' => 'KSD', 'nama' => 'Telaah, Risalah, dan Rancangan Keputusan Menteri',                             'bread' => 'Telaah',             'next_label' => 'Rapat Pembahasan Rancangan Keputusan Menteri Selesai'));
        App\StageHandler::create(array('stage' => 9, 'next' =>10, 'reroute' => 0, 'posisi' => 'DIR', 'nama' => 'Tanda Tangan Risalah Pengolahan Data dan Paraf Rancangan Keputusan Menteri',   'bread' => 'T&P',                'next_label' => 'Tanda Tangan dan Paraf Selesai'));
        App\StageHandler::create(array('stage' =>10, 'next' =>11, 'reroute' => 0, 'posisi' => 'SES', 'nama' => 'Klarifikasi Rancangan & Finalisasi Keputusan Menteri',                         'bread' => 'Sesdit',             'next_label' => 'Finalisasi Selesai'));
        App\StageHandler::create(array('stage' =>11, 'next' =>12, 'reroute' => 0, 'posisi' => 'DIR', 'nama' => 'Disposisi Direktur atas Finalisasi Keputusan Menteri',                         'bread' => 'DIR',                'next_label' => 'Disposisi OK'));
        App\StageHandler::create(array('stage' =>12, 'next' =>13, 'reroute' => 0, 'posisi' => 'DRJ', 'nama' => 'Disposisi Dirjen atas Finalisasi Keputusan Menteri',                           'bread' => 'Dirjen',             'next_label' => 'Disposisi OK'));
        App\StageHandler::create(array('stage' =>13, 'next' =>99, 'reroute' => 0, 'posisi' => 'RKM', 'nama' => 'Penetapan Hukum',                                                              'bread' => 'Biro Hukum',         'next_label' => 'Penetapan Selesai'));

        ////////// dummy data for testing //////////

        $f = Faker::create('id_ID');

        $o = array(
            ['ptsp',        'PTS'],
            ['tu',          'TUS'],
            ['pjm',         'PJM'],
            ['kasubdit',    'KSD'],
            ['direktur',    'DIR'],
            ['sesdit',      'SES'],
            ['dirjen',      'DRJ'],
            ['rokum',       'RKM']
        );

        foreach ($o as $i)
            $u = App\User::create(array('nama' => $f->firstName, 'posisi' => $i[1], 'email' => $i[0].'@demo', 'email_verified_at' => now(), 'password' => Hash::make('password')));

        $u = App\User::create(array('nama' => $f->name, 'posisi' => 'PMH', 'email' => 'pemohon@demo', 'email_verified_at' => now(), 'password' => Hash::make('password')));
        App\Orang::create(array('nama' => $u->nama, 'jabatan' => '', 'alamat' => '', 'kelurahan' => '', 'kecamatan' => '', 'kota' => '', 'provinsi' => '', 'kodepos' => '', 'telp' => '', 'email' => $u->email));

        $j = ['Sekretaris', 'Supervisor', 'Manager', 'Legal'];
        $t = ['B', 'U', 'P'];
        $w = ['Utara', 'Selatan', 'Barat', 'Timur', 'Pusat'];
        $k = ['Setabudi', 'Menteng', 'Mampang', 'Grogol', 'Kedoya', 'Johar', 'Cikini'];
        $u = ['Garment', 'Kimia', 'Bengkel', 'Ternak'];
        $d = 0;

        for ($i=0; $i<10; $i++) {
            $f = Faker::create('id_ID');
            $o = App\Orang::create(array(
                'nama' => $f->name,
                'jabatan' => $j[$f->numberBetween(0, 3)],
                'alamat' => $f->streetAddress,
                'kelurahan' => $k[$f->numberBetween(0, 6)],
                'kecamatan' => $k[$f->numberBetween(0, 6)],
                'kota' => 'Jakarta ' . $w[$f->numberBetween(0, 4)],
                'provinsi' => 'DKI Jakarta',
                'kodepos' => '129' . $f->numberBetween(11, 99),
                'telp' => $f->phoneNumber,
                'email' => $f->companyEmail,
            ));
        }

        for ($i=0; $i<15; $i++) {
            $f = Faker::create('id_ID');
            $p = App\Perusahaan::create(array(
                'nama' => $f->company,
                'alamat' => $f->streetAddress,
                'kelurahan' => $k[$f->numberBetween(0, 6)],
                'kecamatan' => $k[$f->numberBetween(0, 6)],
                'kota' => 'Jakarta ' . $w[$f->numberBetween(0, 4)],
                'provinsi' => 'DKI Jakarta',
                'kodepos' => '129' . $f->numberBetween(11, 99),
                'telp' => $f->phoneNumber,
                'email' => $f->companyEmail,
                'kegiatan' => 'Produksi ' . $u[$f->numberBetween(0, 3)],
                'akta' => $f->numberBetween(10, 99) . '730/IZN-2' . $f->numberBetween(1000, 9000) . '.' . $f->numberBetween(10000, 99000),
                'npp' => '23-23' . $f->numberBetween(1000, 9000),
                'npwp' => '404.27893.' . $f->numberBetween(100, 990),
                'produksi' => $u[$f->numberBetween(0, 3)],
                'kapasitas' => $f->numberBetween(1000, 99000) . ' per hari',
                'kontak' => $f->name . ' ' . $f->phoneNumber,
                'alamatkegiatan' => $f->streetAddress,
                'kelurahankegiatan' => $k[$f->numberBetween(0, 6)],
                'kecamatankegiatan' => $k[$f->numberBetween(0, 6)],
                'kotakegiatan' => 'Jakarta ' . $w[$f->numberBetween(0, 4)],
                'provinsikegiatan' => 'DKI Jakarta',
                'kodeposkegiatan' => '129' . $f->numberBetween(11, 99)
            ));
            if ($i<5) {
                App\Permohonan::create(array(
                    'nama' => $p->nama,
                    'ref_f1_pemohon' => $i+1,
                    'ref_f2_perusahaan' => $p->id,
                    'ref_f3_pengurus' => $i+1,
                    'jenis' => $t[$f->numberBetween(0, 2)],
                    'stage' => 1
                ));
            }
        }
    }
}
