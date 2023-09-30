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
            $table->string('unidad')->nullable()->comment('Unidade de medida');
            $table->integer('cantidad')->nullable();
            $table->foreign('idReceta')
                  ->references('idReceta')
                  ->on('tblReceta')
                  ->onDelete('cascade');
            $table->foreign('idMedicamento')->references('idMedicamento')->on('tblMedicamento')->onDelete('cascade');
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
