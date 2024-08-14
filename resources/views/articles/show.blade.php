@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Artículo</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $article->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $article->id }}</p>
            <p><strong>Descripción:</strong> {{ $article->description }}</p>
            <p><strong>Cantidad:</strong> {{ $article->quantity }}</p>
            <p><strong>Precio:</strong> ${{ number_format($article->price, 2) }}</p>
            <p><strong>ID de Usuario:</strong> {{ $article->user_id }}</p>
            <p><strong>Creado el:</strong> {{ $article->created_at->format('d/m/Y H:i:s') }}</p>
            <p><strong>Actualizado el:</strong> {{ $article->updated_at->format('d/m/Y H:i:s') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este artículo?')">Eliminar</button>
            </form>
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Volver a la lista</a>
        </div>
    </div>
</div>
@endsection
