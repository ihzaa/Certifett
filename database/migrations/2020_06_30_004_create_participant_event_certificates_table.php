<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantEventCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_event_certificates', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('event_id');
            $table->string('certificate_id')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->dateTime('valid_until')->nullable();
            $table->text('congrat_word')->nullable();
            $table->boolean("is_send")->default(0);
            $table->timestamps();

            $table->foreign('certificate_id')->on('certificates')->references('id')->onDelete('cascade');
            $table->foreign('event_id')->on('events')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_event_certificates');
    }
}
