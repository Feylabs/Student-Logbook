<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutabaahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutabaah', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->integer('status'); // 1 = mentoring, 2 = general, 3 = talaqi, 4 = tugas besar
            $table->date('tanggal'); // 1 = mentoring, 2 = general, 3 = talaqi, 4 = tugas besar
            $table->unsignedBigInteger('created_by'); // 1 = mentoring, 2 = general, 3 = talaqi, 4 = tugas besar
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade') ;
            $table->string('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
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
        Schema::dropIfExists('mutabaah');
    }
}
