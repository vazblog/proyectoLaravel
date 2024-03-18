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
        Schema::create('factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->unsignedBigInteger('cita_id')->nullable(); // Permitimos valor nulo para la cita_id
            $table->date('fecha_emision');
            $table->unsignedBigInteger('tratamiento_id');
            $table->decimal('total_tratamiento', 10, 2);
            $table->decimal('total_factura', 10, 2);
            $table->timestamps();

           // Claves foráneas
           $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('set null'); // Modificado para establecer en NULL
           $table->foreign('cita_id')->references('id')->on('cita')->onDelete('set null'); 
           $table->foreign('tratamiento_id')->references('id')->on('tratamiento');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura');
    }

};
