<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('dob');
            $table->string('description');
            $table->string('image');
            $table->enum('availability', ['Available', 'Unavailable'])->default('Available');
            $table->enum('type', ['Dog', 'Cat', 'Aquarium', 'Bird', 'Mammal', 'Rodent', 'Reptile', 'Amphibian', 'Horse'])->default('Dog');
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
        Schema::dropIfExists('animals');
    }
}
