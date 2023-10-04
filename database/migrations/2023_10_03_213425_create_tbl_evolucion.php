<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblEvolucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblEvolucion', function (Blueprint $table) {
            $table->id('idEvolucion');
            $table->unsignedBigInteger('idPaciente');
            $table->unsignedBigInteger('idEtapaActual');
            $table->string('grado', 20)->nullable();
            $table->foreign('idPaciente')
                  ->references('idUsuario')
                  ->on('tblUsuario')
                  ->onDelete('cascade');
            $table->foreign('idEtapaActual')
                    ->references('idEtapa')
                    ->on('tblEtapa')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblEvolucion');
    }
}
