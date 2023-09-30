<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblConsulta', function (Blueprint $table) {
            $table->id('idConsulta');
            $table->unsignedBigInteger('idHistorial');
            $table->date('fechaConsulta')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('valoracion')->nullable();
            $table->text('observaciones')->nullable();
            $table->decimal('peso', 8, 2)->nullable();
            $table->decimal('talla', 8, 2)->nullable();
            $table->date('proxConsulta')->nullable();

            $table->foreign('idHistorial')->references('idHistorial')->on('tblHistorial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblConsulta');
    }
}
