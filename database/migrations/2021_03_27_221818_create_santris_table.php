<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nis')->unique();
            $table->string('password');
            $table->integer('jk')->nullable(); //1 = ikhwan, 2  = akhwat
            $table->string('no_telp')->nullable();
            $table->string('asrama')->nullable()->index();
            $table->string('kelas')->nullable()->index();
            $table->string('jenjang')->nullable();
            $table->string('line_id')->nullable();
            $table->string('photo_path')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('santris');
    }
}
