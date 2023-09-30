<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTblInternacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblInternacion', function (Blueprint $table){
            $table->string('motivo', 200)->nullable();
            $table->string('estado', 15)->default('SOLICITUD')->comment('SOLICITUD | INTERNADO');
            $table->date('fechaIngreso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
