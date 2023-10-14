<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTblTratamiento extends Migration {
    public function up() {
        Schema::table('tblTratamiento', function (Blueprint $table) {
            $table->date('fechaInicio')->nullable();
        });
    }

    public function down() {
        //
    }
}
