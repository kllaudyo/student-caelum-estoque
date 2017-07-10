@extends("layout.principal")
@section("conteudo")
    <h1>Listagem de produtos</h1>
    @if(empty($produtos))
        <p class="alert alert-warning">Você não tem nenhum produto cadastrado.;</p>
    @else
        @if(old('nome'))
            <p class="alert alert-success">O produto <strong>{{old('nome')}}</strong> foi salvo com sucesso!</p>
        @endif
        <table class="table table-striped table-bordered table-hover">
        @foreach($produtos as $p)
        <tr class="{{$p->quantidade <=1 ? "danger" : ""}}">

            <td>{{$p->nome}}</td>
            <td>{{$p->valor}}</td>
            <td>{{$p->descricao}}</td>
            <td>{{$p->quantidade}}</td>
            <td>
                <a href="/produtos/visualizar/{{$p->id}}">
                    Visualizar
                </a>
            </td>
            <td>
                <a href="/produtos/{{$p->id}}/editar">Editar</a>
            </td>
            <td>
                <a href="{{action("ProdutoController@remove",$p->id)}}">
                    remover
                </a>
            </td>
        </tr>
        @endforeach
        </table>
        <h4><span class="label label-danger pull-right">Um ou menos item no estoque</span></h4>
    @endif
@stop