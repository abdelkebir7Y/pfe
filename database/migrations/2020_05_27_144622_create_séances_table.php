<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSéancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('séances', function (Blueprint $table) {
            $table->id();
            $table->integer('emploi');
            $table->string('jour');
            $table->string('heureD');
            $table->string('heureF');
            $table->string('salle');
            $table->string('enseignant');
            $table->string('type');
            $table->string('module');
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
        Schema::dropIfExists('séances');
    }
}
