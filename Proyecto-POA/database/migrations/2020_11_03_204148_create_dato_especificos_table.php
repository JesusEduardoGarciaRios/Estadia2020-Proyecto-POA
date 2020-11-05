<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatoEspecificosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dato_especificos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('datobasicos_id');
            $table->string('denoindicador', 256);
            $table->string('formindicador', 256);
            $table->date('fechacumpli');
            $table->smallInteger('nivelactual')->nullable();
            $table->smallInteger('metaalcanzar');
            $table->smallInteger('primeroavance')->nullable();
            $table->smallInteger('segundoavance')->nullable();
            $table->smallInteger('terceroavance')->nullable();
            $table->text('estrategia');
            $table->timestamps();

            $table->foreign('datobasicos_id')->references('id')->on('dato_basicos')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dato_especificos');
    }
}
