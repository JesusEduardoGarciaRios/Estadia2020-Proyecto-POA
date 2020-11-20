<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatoBasicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dato_basicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('denoproceso', 256);
            $table->smallInteger('numproceso')->nullable();
            $table->enum('mejoraproceso', ['Programa Educativo', 'Proceso de Gestión']);
            $table->string('arearesponsable', 200);
            $table->text('objetivoproceso');
            $table->string('pideatencion', 200);
            $table->text('problematica');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dato_basicos');
    }
}
