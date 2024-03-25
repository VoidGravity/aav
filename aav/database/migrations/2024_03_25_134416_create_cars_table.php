<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('marque', 255)->nullable();
            $table->string('modele', 255)->nullable();
            $table->integer('annee')->nullable();
            $table->integer('kilometrage')->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->integer('puissance')->nullable();
            $table->string('motorisation', 255)->nullable();
            $table->string('carburant', 255)->nullable();
            $table->text('options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
