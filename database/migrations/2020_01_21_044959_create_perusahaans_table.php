<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kodepos');
            $table->string('telp');
            $table->string('faks')->nullable();
            $table->string('email');
            $table->string('kegiatan');
            $table->string('akta');
            $table->string('npp');
            $table->string('npwp');
            $table->string('produksi');
            $table->string('kapasitas');
            $table->string('kontak');
            $table->string('alamatkegiatan');
            $table->string('kelurahankegiatan');
            $table->string('kecamatankegiatan');
            $table->string('kotakegiatan');
            $table->string('provinsikegiatan');
            $table->string('kodeposkegiatan');
            $table->string('flag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perusahaans');
    }
}
