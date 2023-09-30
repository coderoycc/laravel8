<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblrecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblReceta', function (Blueprint $table) {
            $table->id('idReceta');
            $table->unsignedBigInteger('idConsulta');
            $table->string('diagnostico', 200)->nullable();
            $table->string('indicaciones', 240)->nullable();
            $table->foreign('idConsulta')->references('idConsulta')->on('tblConsulta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblreceta');
    }
}
