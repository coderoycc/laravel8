<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticoCIETable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblDiagnosticoCIE', function (Blueprint $table) {
            $table->string('codigo_cie', 20)->charset('utf8')->collation('utf8_unicode_ci');
            $table->text('descripcion')->charset('utf8')->collation('utf8_unicode_ci')->nullable();
            $table->text('cod_desc_cie')->charset('utf8')->collation('utf8_unicode_ci')->nullable();
            $table->primary('codigo_cie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblDiagnosticoCIE');
    }
}
