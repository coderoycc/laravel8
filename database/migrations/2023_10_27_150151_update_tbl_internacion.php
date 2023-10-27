<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTblInternacion extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::table('tblinternacion', function (Blueprint $table) {
        $table->date('fechaInternacion')->nullable();
        $table->date('fechaEgreso')->nullable();
        $table->string('observacionEgreso', 255)->nullable();
        $table->string('motivoEgreso', 20)->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      
    }
}
