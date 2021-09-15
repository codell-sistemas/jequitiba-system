<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('senha');
            $table->string('remember_me')->nullable();
            $table->timestamps();
        });
        
        //DEV
        \Illuminate\Support\Facades\DB::table('usuario')->insert(
            array(
                'nome' => 'Admin',
                'email' => 'admin@codell.com.br',
                'senha' => md5('codell#123')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
