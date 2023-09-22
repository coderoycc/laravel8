<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUsuario');
            $table->date('fechaConsulta')->default(\Carbon\Carbon::now()->toDateString());
            $table->text('evolucion');
            $table->string('valoracion', 250)->nullable();
            $table->string('observaciones', 250)->nullable();
            $table->decimal('peso')->nullable();
            $table->decimal('talla', 3, 2)->nullable();
            $table->date('proxConsulta')->nullable();
            $table->string('internacion', 2)->default('NO');
            $table->timestamps();
            // Definir la llave foránea
            $table->foreign('idUsuario')->references('idUsuario')->on('tblUsuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial');
    }
}
