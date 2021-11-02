<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hari_id');
            $table->integer('kelas_id');
            $table->integer('mhs_id');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('judul');
            $table->string('tanggal');
            $table->string('promotor');
            $table->string('kopromotor_1');
            $table->string('kopromotro_2');
            $table->string('penguji_1');
            $table->string('penguji_2');
            $table->string('penguji_3');
            $table->string('penguji_4');
            $table->string('penguji_5');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
