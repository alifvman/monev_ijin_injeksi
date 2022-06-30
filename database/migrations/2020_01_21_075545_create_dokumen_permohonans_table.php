<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_permohonans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('permohonan_id');
            $table->bigInteger('dokumen_id');
            $table->string('filename');
            $table->string('ext');
            $table->string('mime');
            $table->string('pathname');
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
        Schema::dropIfExists('dokumen_permohonans');
    }
}
