<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblHistorial', function (Blueprint $table) {
            $table->id('idHistorial');
            $table->unsignedBigInteger('idPaciente');
            $table->unsignedBigInteger('idMedico');
            $table->string('procedencia')->nullable(false)->commnet('Interconsulta o Externo');
            $table->string('servicio')->nullable(false)->commnet('Oncología, Hematología o Emergencia');
            $table->date('fechaRegistro')->default(\Carbon\Carbon::now()->toDateString());
            $table->date('fechaConsulta')->nullable(false);
            $table->string('atendido', 2)->default('NO');

            //llenado por el medico
            $table->string('tipoCancer', 100)->nullable();
            $table->string('etapa', 100)->comment('(estado) Bajo, Medio, Alto');
            $table->string('diagnosticoscie',150)->nullable()->comment('Ids de los diagnositvos separados por comas');
            $table->text('valoracion')->nullable();
            $table->text('observacion')->nullable();
            $table->decimal('peso', 3)->nullable();
            $table->decimal('talla', 3, 2)->nullable();
            $table->timestamps();
            // Definir la llave foránea paciente
            $table->foreign('idPaciente')->references('idUsuario')->on('tblUsuario');
            // Definir la llave foránea paciente
            $table->foreign('idMedico')->references('idUsuario')->on('tblUsuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblHistorial');
    }
}
