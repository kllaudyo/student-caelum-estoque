<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
 * ---------------------------------------------------
 * Recado para claudio
 * ---------------------------------------------------
 * Você está na página 37 do livro
 */


/*
 * -----------------------------------------------------
 * Claudio Acioli: comandos migrate
 * -----------------------------------------------------
 * criar: php artisan make:migrate nome
 * executar: php artisan migrate
 * desfazer: php artisan migrate:rollback
 */

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nome");
            $table->decimal("valor", 10, 2);
            $table->string("descricao");
            $table->integer("quantidade");
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
        Schema::dropIfExists('produtos');
    }
}
