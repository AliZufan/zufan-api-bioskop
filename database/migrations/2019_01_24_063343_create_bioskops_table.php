<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBioskopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bioskops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->string('thumbnail')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('genre')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('durasi')->nullable();
            $table->date('rilis')->nullable();
            $table->string('harga')->nullable();
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
        Schema::dropIfExists('bioskops');
    }
}
