@extends('layouts.app')

@section('title', 'Atualizar Usuário')

@section('content')
    <div class="container-fluid ps-4">
        <h3 class="text-primary">Atualizar Usuário</h3>
        <form action = "{{ route('user-update',  ['user' => $user]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('users.components.user-form')
            @include('form-actions')
        </form>
    </div>
@endsection
