@extends('layouts.app')

@section('title', 'Cadastrar Usuário')

@section('content')
    <div class="container-fluid ps-4">
        <h3 class="text-primary">Cadastrar Usuário</h3>
        <form class="d-flex flex-column" style="min-height: 85vh" action = "{{ route('user-store') }}" method="POST">
            @csrf
            @include('users.components.user-form')
            @include('form-actions')
        </form>
    </div>
@endsection
