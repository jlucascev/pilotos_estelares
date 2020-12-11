<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('naves', function (Blueprint $table) {
            $table->id();

            $table->string('modelo',50);
            $table->string('version',50)->nullable();
            $table->unsignedBigInteger('horas_vuelo');
            $table->date('fecha_fabricacion');
            $table->string('fabricante',50);
            $table->enum('tipo',['caza','interceptor','bombardero']);



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
        Schema::dropIfExists('naves');
    }
}
