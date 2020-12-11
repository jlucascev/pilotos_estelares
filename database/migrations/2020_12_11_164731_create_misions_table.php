<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('piloto_id')->constrained();

            $table->foreignId('nave_id')->constrained();

            $table->unsignedSmallInteger('horas');

            $table->unsignedSmallInteger('derribos')->default(0);

            $table->text('informe')->nullable();

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
        Schema::dropIfExists('misions');
    }
}
