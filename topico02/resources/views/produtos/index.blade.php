<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>

<body>
    <h1>Produtos</h1>
    {{-- @auth --}}
        {{-- Só mostra se existir uma sessão ativa --}}
        <a href="{{ route('produtos.create') }}">Criar Novo Produto</a>
    {{-- @endauth --}}
    @if ($listProdutos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>qtd_estoque</th>
                    <th>preco</th>
                    <th>Importado</th>
                    @auth
                        <th colspan="2">Ações</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($listProdutos as $produto)
                    <tr>
                        <td>
                            <a href="{{ route('produtos.show', $produto->id) }}">{{ $produto->id }}</a>
                        </td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->qtd_estoque }}</td>
                        <td>{{ $produto->preco }}</td>
                        <td>{{ $produto->importado ? 'Sim' : 'Não' }}</td>
                        @auth
                            <td><a href="{{ route('produtos.edit', $produto->id) }}">Editar</a></td>
                            <td><a href="{{ route('produtos.delete', $produto->id) }}">Deletar</a></td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Produtos não encontrados! </p>
    @endif
</body>

</html>
