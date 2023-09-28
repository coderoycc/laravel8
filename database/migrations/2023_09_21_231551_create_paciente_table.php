<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreatePacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblUsuario', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->string('apellidos', 100);
            $table->string('nombres', 100);
            $table->string('ci', 20)->nullable(false);
            $table->string('email', 100)->nullable(false);
            $table->string('rol', 20);
            $table->string('password')->default(Hash::make('admin2023'));
            $table->string('genero', 1)->nullable(); // opcionales
            $table->string('celular',20)->nullable(); // opcionales
            $table->date('fechaNac')->nullable(); // opcionales
            // campos paciente
            $table->string('codPaciente', 20)->nullable();
            $table->string('codSus', 50)->nullable();
            //campos medico
            $table->string('especialidad', 100)->nullable();
            $table->string('matProfesional', 50)->nullable();
            
            $table->rememberToken();
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
        Schema::dropIfExists('tblUsuario');
    }
}
