@extends('layouts.app')

@section('title', 'Atualizar Atendimento')

@section('content')
    <div class="container-fluid ps-4">
        <h3 class="text-primary">Atualizar Atendimento</h3>
        <form action = "{{ route('service-update', ['service' => $service->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('services.components.service-form')
            @include('form-actions')
        </form>
    </div>
@endsection


