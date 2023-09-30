<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('idMedico');
            $table->string('indicaciones',200)->nullable();
            $table->text('motivo')->nullable();
            $table->string('estado', 15)->default('SOLICITUD')->comment('SOLICITUD | INTERNADO');
            $table->date('fechaSolicitud')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('idPaciente')->references('idUsuario')->on('tblUsuario');
            $table->foreign('idMedico')
                  ->references('idUsuario')
                  ->on('tblusuario')
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
        Schema::dropIfExists('tbl_internacion');
    }
}
