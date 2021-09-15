<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamento', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('id_categoria');
            $table->string('tipo');
            $table->string('valor');
            $table->dateTime('data_vencimento');
            $table->integer('baixa');
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
        Schema::dropIfExists('lancamento');
    }
}
