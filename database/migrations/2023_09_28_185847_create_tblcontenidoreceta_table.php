<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcontenidorecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblContenidoreceta', function (Blueprint $table) {
            $table->id('idContenidoReceta');
            $table->unsignedBigInteger('idReceta');
            $table->unsignedBigInteger('idMedicamento');
            $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblcontenidoreceta');
    }
}
