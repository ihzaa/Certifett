<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateSpecificPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_specific_properties', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('gambar')->nullable();
            $table->string('data');
            $table->string('certificate_id');
            $table->timestamps();
            $table->foreign('certificate_id')->on('certificates')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate_specific_properties');
    }
}
