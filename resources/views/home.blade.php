@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{
                    Auth::user()->name . ' estas logueado'
                    }}

                    <div class="card">
                        <h4>Articulos creados: {{ $articleCount }}</h4>
                    </div>

                    <a href="{{ route('articles.index') }} " class="btn btn-primary">Ver articulos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
