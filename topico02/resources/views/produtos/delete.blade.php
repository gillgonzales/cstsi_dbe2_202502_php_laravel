<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>

<body>
    @if ($produto)
        <h1>{{ $produto->nome }}</h1>
        <p>{{ $produto->descricao }}</p>
        <ul>
            <li>Quantidade: {{ $produto->qtd_estoque }}</li>
            <li>Preço: {{ $produto->preco }}</li>
            <li>Importado: {{ $produto->importado ? 'Sim' : 'Não' }}</li>
        </ul>
        <form id='delete' action="{{route('produtos.destroy',$produto->id)}}" method="POST">
            @method('delete')
            @csrf
        </form>
        <button form='delete'>Excluir Definitivamente!!!</button> |
        <a  href="/produtos"><button>Cancelar</button></a><hr>
    @else
        <p>Produto não encontrado! </p>
    @endif
    <a href="/produtos">&#9664;Voltar</a>
</body>

</html>
