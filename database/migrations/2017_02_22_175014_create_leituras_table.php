<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeiturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leituras', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTimeTz('horario_leitura');
            $table->text('valor_temperatura');
            $table->text('valor_umidade');
            $table->integer('placa_id')->unsigned();
            $table->timestamps();

            $table->foreign('placa_id')
                  ->references('id')->on('placas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leituras');
    }
}
