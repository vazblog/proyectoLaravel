<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('DNI', 9)->unique()->nullable(); // Añade nullable()
            $table->string('name');
            $table->string('apellido_uno')->nullable();
            $table->string('apellido_dos')->nullable();
            $table->string('photo')->nullable();
            $table->date('fecha_nac')->nullable(); // Añade nullable()
            $table->unsignedBigInteger('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('cp')->nullable();
            $table->string('poblacion')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('perfil_id')->nullable(); // Añade nullable()
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('perfil_id')->references('id')->on('perfiles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
