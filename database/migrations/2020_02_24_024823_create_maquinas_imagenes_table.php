<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaquinasImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquina_imagenes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('maquina_id')->nullable();
            $table->integer('componente_id')->nullable();
            $table->string('imagen',100);            
            $table->string('descripcion',600)->nullable();
            $table->integer('numero_orden');
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
        Schema::dropIfExists('maquina_imagenes');
    }
}
