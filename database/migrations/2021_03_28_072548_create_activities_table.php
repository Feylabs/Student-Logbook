<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->unsignedBigInteger('mutabaah_id'); // 1 = mentoring, 2 = general, 3 = talaqi, 4 = tugas besar
            $table->foreign('mutabaah_id')->references('id')->on('mutabaah')->onDelete('cascade') ;
            $table->integer('poin');
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('activity');
    }
}
