<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblContenidoTrat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblContenidoTrat', function (Blueprint $table) {
            $table->id('idContenidoTrat');
            $table->unsignedBigInteger('idTratamiento');
            $table->unsignedBigInteger('idMedicamento');
            $table->string('dosis', 100)->nullable();
            $table->foreign('idTratamiento')
                  ->references('idTratamiento')
                  ->on('tblTratamiento')
                  ->onDelete('cascade');
            $table->foreign('idMedicamento')
                  ->references('idMedicamento')
                  ->on('tblMedicamento')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblContenidoTrat');
    }
}
