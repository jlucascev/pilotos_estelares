<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsociarPilotoNave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pilotos', function (Blueprint $table) {
            //
            $table->foreignId('nave_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pilotos', function (Blueprint $table) {
            //
            $table->dropForeign(['nave_id']);
            $table->dropColumn('nave_id');
        });
    }
}