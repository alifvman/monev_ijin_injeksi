<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageHandlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_handlers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stage');
            $table->string('posisi');
            $table->string('nama');
            $table->string('bread');
            $table->integer('next')->default(0);
            $table->integer('reroute')->default(0);
            $table->string('next_label')->nullable();
            $table->string('reroute_label')->nullable();
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
        Schema::dropIfExists('stage_handlers');
    }
}
