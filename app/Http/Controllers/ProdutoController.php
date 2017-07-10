<?php

namespace estoque\Http\Controllers;

use estoque\Produto;
use estoque\Http\Requests\ProdutoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{

    function __construct()
    {
        $this->middleware('auth',['only'=>['adiciona','remove','editar']]);
    }

    /*
     * -----------------------------------------------------
     * Claudio Acioli: comandos migrate
     * -----------------------------------------------------
     * view()->exists("nome_arquivo") verifica se o arquivo existe
     * view()->file("caminho/diferente/de_uma_view) um arquivo diferente
     * view("nome_arquivo",["chave"=>"valor"]) passando array chave e valores
     * view("nome_arquivo")->with("chave","valor")
     * view("nome_arquivo")->withChave(valor)
    */
    public function lista()
    {
        //$produtos = DB::select("select * from produtos");
        $produtos = Produto::all();
        if(view()->exists("produto/listagem"))
        {
            return view("produto.listagem",["produtos"=>$produtos]);
        }
    }

    /*
     * -----------------------------------------------------
     * Claudio Acioli: Classe Request
     * -----------------------------------------------------
     * Request->input("key","default_value") retorna parametro enviado, post, get, etc.
     * Request->has("key") verifica se o parametro existe
     * Request->only("key1,key2,key3...") retorna apenas as keys informadas
     * Request->except("key") todos exceto a key
     * Request->all() todos os parametros
     * Request->url() retorna toda a url atual
     * Request->path() retorna apenas o path atual
     * Request->route("key1","key2"...) {key1} referente
     */

    public function mostra(Request $request)
    {

        $id = $request->route("id");
        //$produto = DB::select("select * from produtos where id=? ", [$id]);
        $produto = Produto::find($id);
        if(empty($produto)){
            return "Esse produto não existe";
        }

        return view("produto.detalhes",["produto" => $produto]);
    }

    public function novo(Request $request)
    {
        return view("produto.formulario");
    }

//    public function adiciona(Request $request)
//    {
//        $nome = $request->input("nome");
//        $descricao = $request->input("descricao");
//        $valor = $request->input("valor");
//        $quantidade = $request->input("quantidade");
//
//        #Usando sql puro
//        //DB::insert("insert into produtos(nome, valor, descricao, quantidade) values (?,?,?,?)", array($nome, $valor, $descricao, $quantidade));
//        #Usando o Query Builder
//        DB::table("produtos")->insert(array("nome"=>$nome, "valor"=>$valor, "descricao"=>$descricao, "quantidade"=>$quantidade));
//
//        return redirect()->route("listagemProdutos")->withInput($request->only("nome")); //usando apelidos
//        //return redirect()->action("ProdutoController@lista")->withInput($request->only("nome")); // mais rapido e não corre risco de quebra de link
//        //return redirect("/produtos")->withInput($request->only("nome"));
//        //return view("produto.adicionado")->with("nome", $nome);
//
//    }

//    public function adiciona(Request $request)
//    {
//        $produto = new Produto();
//        $produto->nome = $request->input("nome");
//        $produto->descricao = $request->input("descricao");
//        $produto->valor = $request->input("valor");
//        $produto->quantidade = $request->input("quantidade");
//        $produto->save();
//
//        return redirect()->action("ProdutoController@lista")->withInput($request->only("nome"));
//    }

//    public function adiciona(Request $request){
//        $parametros = $request->all();
//        $produto = new Produto($parametros);
//        $produto->save();
//        return redirect()->action("ProdutoController@lista")->withInput($request->only("nome"));
//    }

    public function adiciona(ProdutoRequest $request)
    {
        Produto::create($request->all());
        return redirect()->action("ProdutoController@lista")->withInput($request->only("nome"));
    }

    public function remove($id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return redirect()->action("ProdutoController@lista");
    }

    public function listaJson()
    {
        //por padrão o Laravel já retorna JSON caso vc retorne uma variavel ou array
        //$produtos = DB::select("select * from produtos");
        //return $produtos;
        //mas caso queira ser explicito use, repare q estamos usando o Eloquent aqui ao inves do sql normal
        $produtos = Produto::all();
        return response()->json($produtos);

        //essa classe response tem outros metodos interessantes como downloads de arquivos
        //response()->download("caminho do arquivo");
    }

    public function editar($id)
    {
        $produto = Produto::find($id);
        if(!empty($produto)){
            return view("produto.formulario",["produto"=>$produto]);
        }
        return "não existe este produto";
    }

    public function alterar(ProdutoRequest $request){
        $produto = Produto::find($request->input("id"));
        if(!empty($produto)){
            $produto->nome = $request->input("nome");
            $produto->descricao = $request->input("descricao");
            $produto->valor = $request->input("valor");
            $produto->quantidade = $request->input("quantidade");
            $produto->save();
            return redirect()->action("ProdutoController@lista")->withInput($request->only("nome"));
        }
        return "Error ao alterar produto";
    }

}
