<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('permohonan_id');
            $table->string('jenis');

            $table->string('f1nama');
            $table->string('f1jabatan');
            $table->string('f1alamat');
            $table->string('f1kelurahan');
            $table->string('f1kecamatan');
            $table->string('f1kota');
            $table->string('f1provinsi');
            $table->string('f1kodepos');
            $table->string('f1telp');
            $table->string('f1faks')->nullable();
            $table->string('f1email');

            $table->string('f2nama');
            $table->string('f2alamat');
            $table->string('f2kelurahan');
            $table->string('f2kecamatan');
            $table->string('f2kota');
            $table->string('f2provinsi');
            $table->string('f2kodepos');
            $table->string('f2telp');
            $table->string('f2faks')->nullable();
            $table->string('f2email');
            $table->string('f2kegiatan');
            $table->string('f2akta');
            $table->string('f2npp');
            $table->string('f2npwp');
            $table->string('f2produksi');
            $table->string('f2kapasitas');
            $table->string('f2kontak');
            $table->string('f2alamatkegiatan');
            $table->string('f2kelurahankegiatan');
            $table->string('f2kecamatankegiatan');
            $table->string('f2kotakegiatan');
            $table->string('f2provinsikegiatan');
            $table->string('f2kodeposkegiatan');

            $table->string('f3nama');
            $table->string('f3jabatan');
            $table->string('f3alamat');
            $table->string('f3kelurahan');
            $table->string('f3kecamatan');
            $table->string('f3kota');
            $table->string('f3provinsi');
            $table->string('f3kodepos');
            $table->string('f3telp');
            $table->string('f3faks')->nullable();
            $table->string('f3email');

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
        Schema::dropIfExists('arsips');
    }
}
