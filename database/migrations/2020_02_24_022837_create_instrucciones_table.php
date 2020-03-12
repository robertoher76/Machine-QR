<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstruccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrucciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('maquina_id');
            $table->integer('instrucciones_tipo_id');
            $table->string('titulo',50);
            $table->string('descripcion',600);
            $table->integer('numero_orden');
            $table->softDeletes();
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
        Schema::dropIfExists('instrucciones');
    }
}
