<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->dateTime('fecha_hora');
            $table->unsignedBigInteger('tratamiento_id');
            $table->unsignedBigInteger('empleado_id');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->unique(['cliente_id', 'fecha_hora', 'empleado_id']);

            // Agregar restricción de eliminación en cascada
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
            $table->foreign('tratamiento_id')->references('id')->on('tratamiento');
            $table->foreign('empleado_id')->references('id')->on('empleado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cita');
    }

};
