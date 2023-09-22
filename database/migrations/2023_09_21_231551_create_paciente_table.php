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
            $table->string('usuario', 30)->unique();
            $table->string('apellidos', 100);
            $table->string('nombres', 100);
            $table->string('ci', 20);
            $table->string('rol', 10);
            $table->date('fechaNac')->nullable();
            $table->string('especialidad', 100)->nullable();
            $table->string('genero', 1)->nullable();
            $table->string('password')->default(Hash::make('admin2023'));
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
