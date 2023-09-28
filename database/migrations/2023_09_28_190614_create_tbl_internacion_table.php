<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInternacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblInternacion', function (Blueprint $table) {
            $table->id('idInternacion');
            $table->unsignedBigInteger('idPaciente');
            $table->text('indicaciones')->nullable();
            $table->date('fechaSolicitud')->default(\Carbon\Carbon::now()->toDateString());
            $table->date('fechaIngreso');
            $table->foreign('idPaciente')->references('idUsuario')->on('tblUsuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_internacion');
    }
}
