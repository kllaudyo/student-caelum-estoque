<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/*
 * -----------------------------------------------------
 * Claudio Acioli: comandos seed
 * -----------------------------------------------------
 * executar php artisan db:seed
 */

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ProdutoTableSeeder::class);
    }
}

class ProdutoTableSeeder extends Seeder
{
    public function run(){
        DB::insert(
            "insert into produtos (nome, quantidade, valor, descricao) values (?,?,?,?)",
            array("Geladeira", 2, 6900.00, 'Side by side com gelo na porta')
        );

        DB::insert(
            "insert into produtos (nome, quantidade, valor, descricao) values (?,?,?,?)",
            array("Fogão", 5, 950.00, 'Painel automático e forno elétrico')
        );

        DB::insert(
            "insert into produtos (nome, quantidade, valor, descricao) values (?,?,?,?)",
            array("Microondas Android", 1, 1520.00, 'Manda sms quando termina de esquentar')
        );
    }
}