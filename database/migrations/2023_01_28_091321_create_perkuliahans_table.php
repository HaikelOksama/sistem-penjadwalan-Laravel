<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkuliahans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_dosen_matakuliah');
            
            $table->string('hari');
            $table->time('waktu');
            
            $table->year('tahun');
            $table->integer('semester');
            $table->string('kelas');
            
            //define foreign keys
            $table->foreign('id_kelas')->references('id')->on('ruang_kelas')->onDelete('cascade');
            $table->foreign('id_dosen_matakuliah')->references('id')->on('dosen_matakuliah')->onDelete('cascade');

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
        Schema::dropIfExists('perkuliahans');
    }
};
