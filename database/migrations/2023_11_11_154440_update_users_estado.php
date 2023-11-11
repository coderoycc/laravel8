<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersEstado extends Migration {
  public function up() {
    Schema::table('tblUsuario', function (Blueprint $table) {
      $table->string('estado', 50)->default('ALTA');
      $table->date('fechaBaja')->nullable();
    });
  }

  public function down() {
    //
  }
}
