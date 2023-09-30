<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDiagnosticosPacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDiagnosticosPaciente', function (Blueprint $table) {
            $table->id('idDiagnosticoPaciente');
            $table->unsignedBigInteger('idHistorial');
            $table->string('idDiagnosticoCIE', 20)->charset('utf8')->collation('utf8_unicode_ci');
            $table->foreign('idHistorial')->references('idHistorial')->on('tblHistorial');
            $table->foreign('idDiagnosticoCIE')->references('codigo_cie')->on('tblDiagnosticoCIE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblDiagnosticosPaciente');
    }
}
