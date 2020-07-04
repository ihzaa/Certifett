<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('date');
            $table->integer('capacity');
            $table->unsignedBigInteger('user_owner');
            $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('certificate_id')->unique();
            $table->timestamps();

            $table->foreign('user_owner')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('receipt_id')->on('receipts')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
}
