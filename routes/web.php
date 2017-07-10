<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/produtos",  array("as"=>"listagemProdutos","uses"=>"ProdutoController@lista"));

Route::get("/produtos/visualizar/{id}", "ProdutoController@mostra")->where("id","[0-9]+");

Route::get("/produtos/novo", "ProdutoController@novo");

Route::post("/produtos/adiciona", "ProdutoController@adiciona");

Route::post("/produtos/altera", "ProdutoController@alterar");

Route::get("/produtos/json", "ProdutoController@listaJson");

Route::get("/produtos/remove/{id}", "ProdutoController@remove");

Route::get("/produtos/{id}/editar", "ProdutoController@editar")->where("id","[0-9]+");

Route::get("/loginx", "LoginController@login");

/*
 * -----------------------------------------------------
 * Claudio Acioli: Classe Request
 * -----------------------------------------------------
 * query param -> parametro de busca. Ex. ?q=busca&d=dia&s=sort
 * path param -> parametro de rota. Ex. /busca/dia/sort
 *
 * Normalmente parametros de rota são usados quando o paremtro é obrigatório
 */
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
