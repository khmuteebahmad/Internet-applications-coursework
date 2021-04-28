<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdoptionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('animalId');
            $table->string('petname');
            $table->string('username');
            $table->enum('accepted', ['Approved','Pending', 'Rejected'])->default('Pending');
            $table->timestamps();

            // $table->foreign('animalId')->references('id')->on('animals');
            // $table->foreign('username')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoption_requests');
    }
}
