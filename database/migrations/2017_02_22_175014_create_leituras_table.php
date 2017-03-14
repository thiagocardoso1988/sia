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
            $table->float('valor_temperatura', 2, 2);
            $table->float('valor_umidade', 2, 2);
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
