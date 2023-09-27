<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHistorial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblHistorial', function (Blueprint $table) {
            $table->dropColumn('caso');
            $table->dropColumn('datosIngreso');
            $table->string('diagnosticos')->nullable()->comment('Ids enfermedades separados con comas');
            $table->json('medicamentos')->nullable()->comment('Json de medicamenteos idMedicamento:dosis');
            $table->string('observaciones', 250)->nullable();
            $table->string('antecedentes')->nullable();
            $table->decimal('peso', 3, 2)->nullable();
            $table->decimal('talla', 3, 2)->nullable();
            $table->date('proxConsulta')->nullable();
        });
    }

}
