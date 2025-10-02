@extends('layouts.app')

@section('title', 'Acesso Negado')

@section('content')
    <div class="d-flex flex-column vh-100">
        <div class="text-center mt-auto mb-auto">
            <h1 class="text-danger mb-2">ACESSO NEGADO!</h1>
            <p>Você não tem permissão para acessar essa página!</p>
        </div>
        <div class="ms-3 mb-5">
            <a href="javascript:history.back()" class="btn btn-primary">VOLTAR</a>
        </div>
    </div>
@endsection
