<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantriMutabaahRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri_mutabaah_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('santri_id');
            $table->unsignedBigInteger('mutabaah_id');
            $table->unsignedBigInteger('activity_id');
            $table->string('status')->nullable();
            $table->string('deleted_at')->nullable();

            $table->foreign('santri_id')->references('id')->on('santri')->onDelete('cascade') ;
            $table->foreign('mutabaah_id')->references('id')->on('mutabaah')->onDelete('cascade') ;
            $table->foreign('activity_id')->references('id')->on('activity')->onDelete('cascade') ;
            
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
        Schema::dropIfExists('santri_mutabaah_records');
    }
}
