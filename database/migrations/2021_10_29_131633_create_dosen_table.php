<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_card', 10);
            $table->string('nip', 30)->nullable();
            $table->string('nama_dosen', 50);
            $table->integer('team_id');
            $table->string('kode', 5)->nullable();
            $table->enum('jk', ['L', 'P']);
            $table->string('pangkat_golongan', 50)->nullable();
            $table->string('foto');
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
        Schema::dropIfExists('dosen');
    }
}
