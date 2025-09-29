@extends('layouts.app')

@section('title', 'Acesso Negado')

@section('content')
    <div class="text-center mt-5">
        <h1 class="text-danger">Acesso negado</h1>
        <p>Você não tem permissão para acessar essa página!</p>
        <a href="javascript:history.back()" class="btn btn-primary">Voltar</a>
    </div>
@endsection
