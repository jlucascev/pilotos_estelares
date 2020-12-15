<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMecanicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mecanicos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre',50);
            $table->string('apellidos',100);
            $table->date('fecha_nacimiento');
            $table->date('fecha_contrato');
            $table->float('salario',6,2);
            $table->unsignedInteger('codigo');
            $table->timestamps();
            $table->unique('codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mecanicos');
    }
}
