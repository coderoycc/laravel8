<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTratamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTratamiento', function (Blueprint $table) {
            $table->id('idTratamiento');
            $table->unsignedBigInteger('idEtapa');
            $table->unsignedBigInteger('idEvolucion');
            $table->string('tieneMedicamentos', 2)->default('NO');
            $table->foreign('idEtapa')
                  ->references('idEtapa')
                  ->on('tblEtapa')
                  ->onDelete('cascade');
            $table->foreign('idEvolucion')
                  ->references('idEvolucion')
                  ->on('tblEvolucion')
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
        Schema::dropIfExists('tblTratamiento');
    }
}
