<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendSeguimtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calend_seguimtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('datoespecificos_id');
            $table->string('actividad', 256);
            $table->string('unidadmedida', 256);
            $table->smallInteger('metaanual');
            $table->smallInteger('prog1')->nullable();
            $table->smallInteger('alc1')->nullable();
            $table->smallInteger('prog2')->nullable();
            $table->smallInteger('alc2')->nullable();
            $table->smallInteger('prog3')->nullable();
            $table->smallInteger('alc3')->nullable();
            $table->string('justificacion', 256)->nullable();
            $table->string('areaoperadora', 256);
            $table->timestamps();

            $table->foreign('datoespecificos_id')->references('id')->on('dato_especificos')
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
        Schema::dropIfExists('calend_seguimtos');
    }
}
