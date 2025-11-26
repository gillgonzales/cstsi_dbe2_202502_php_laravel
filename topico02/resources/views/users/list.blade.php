<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Users</title>
</head>
<body>
 <h1>Lista de Usuários</h1>
 @if($listaDeUsuarios->count()>0)
 <ul>
    @foreach ($listaDeUsuarios as $item)
        <li>{{$item->name}}</li>
    @endforeach
 </ul>
@endif
</body>
</html>
