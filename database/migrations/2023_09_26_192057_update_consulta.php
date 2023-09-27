<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateConsulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblConsulta', function (Blueprint $table) {
            $table->json('medicamentos')->nullable()->comment('Json de medicamenteos idMedicamento:dosis');
        });
    }
}
