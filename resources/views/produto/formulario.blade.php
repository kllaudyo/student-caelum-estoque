@extends("layout.principal")
@section("conteudo")
    <h1>Salvar Produto</h1>
    @if(count($errors->all()) >0)
        <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif
    <form action="{{empty($produto)?"/produtos/adiciona":"/produtos/altera"}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        @unless(empty($produto))
            <input type="hidden" name="id" value="{{$produto->id}}" />
        @endunless
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{$produto->nome or old('nome')}}" />
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="{{$produto->descricao or old('descricao')}}" />
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor" class="form-control" value="{{$produto->valor or old('valor')}}" />
        </div>
        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{$produto->quantidade or old('quantidade')}}" />
        </div>
        <button type="submit" class="btn btn-primary btn-block">{{empty($produto)?"Adicionar":"Salvar"}}</button>
    </form>
@stop