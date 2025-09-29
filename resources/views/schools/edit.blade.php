@extends('layouts.app')

@section('title', 'Atualizar Visita')

@section('content')
    <div class="container-fluid ps-4">
        <h3 class="text-primary">Atualizar Escola</h3>
        <form action = "{{ route('school-update',  ['school' => $school]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('schools.components.school-form')
            @include('form-actions')
        </form>
    </div>
@endsection

