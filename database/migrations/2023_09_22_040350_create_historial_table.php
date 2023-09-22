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
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idMedico');
            $table->string('caso', 250)->nullable();
            $table->date('fechaRegistro')->default(\Carbon\Carbon::now()->toDateString());
            $table->text('datosIngreso');
            $table->timestamps();
            // Definir la llave foránea paciente
            $table->foreign('idUsuario')->references('idUsuario')->on('tblUsuario');
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
