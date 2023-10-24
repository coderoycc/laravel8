<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBiometrico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biometrico', function (Blueprint $table) {
            $table->id('idBiometrico');
            $table->string('ci', 20)->nullable(false);
            $table->dateTime('horaRegistro')->nullable(false);
            $table->string('estado', 20)->default('NO ATENDIDO')->comment('NO ATENDIDO | ATENDIDO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biometrico');
    }
}
