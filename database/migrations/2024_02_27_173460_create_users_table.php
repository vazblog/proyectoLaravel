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
            $table->string('DNI', 9)->unique();
            $table->string('name');
            $table->string('apellido_uno');
            $table->string('apellido_dos');
            $table->string('photo')->nullable();
            $table->date('fecha_nac');
            $table->unsignedBigInteger('telefono');
            $table->string('direccion');
            $table->integer('cp');
            $table->string('poblacion');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('perfil_id');
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
