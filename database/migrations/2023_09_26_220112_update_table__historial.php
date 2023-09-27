<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableHistorial extends Migration
{

    public function up()
    {
        Schema::table('tblHistorial', function (Blueprint $table) {
            $table->string('atendido', 2)->default('NO')->comment('Estado para ver si ya hizo su primera consulta (valoracion)');
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
