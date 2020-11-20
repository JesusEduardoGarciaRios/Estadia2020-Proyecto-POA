<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursoRequeridosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurso_requeridos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('calendseguimtos_id');
            $table->string('concepto', 256);
            $table->unsignedBigInteger('partidapresu_id');
            $table->string('unidadmedida', 256);
            $table->smallInteger('cantidad');
            $table->decimal('costoaprox', 11, 2);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('calendseguimtos_id')->references('id')->on('calend_seguimtos')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('partidapresu_id')->references('id')->on('partida_presupuestales')
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
        Schema::dropIfExists('recurso_requeridos');
    }
}
