@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Artículos</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Crear nuevo artículo</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-hovered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Articulo</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Creado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->name }}</td>
                <td>{{ $article->description }}</td>
                <td>{{ $article->quantity }}</td>
                <td>{{ $article->price }}</td>
                <td>{{ $article->user->name }}</td>
                <td>
                    <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info">Ver</a>
                    @if(Auth::user()->id === $article->user->id)
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este artículo?')">Eliminar</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
