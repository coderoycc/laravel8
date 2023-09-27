<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTblUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblUsuario', function (Blueprint $table) {
            $table->string('celular',10)->nullable();
            $table->string('email',50)->unique()->nullable();
            $table->string('codPaciente')->unique()->nullable();
        });
    }
}
