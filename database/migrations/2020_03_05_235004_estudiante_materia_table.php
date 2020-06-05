<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstudianteMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante_materia', function (Blueprint $table) {
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiante_materia');
    }
}
