@extends('layouts.app')

@section('title', 'Visualizar Escola')

@section('content')
    <div class="container-fluid ps-4">
        <h3 class="text-primary">Informações da Escola</h3>
        <div class="container-fluid ps-4 text-start mt-4 border rounded shadow-sm bg-light">
            <div class="row gx-3 gy-3 mb-3 mt-2">
                <div class="col-12 col-md-6">
                    <div class="p-0 text-primary fw-bold">Município:</div>
                    <div class="p-0">{{ $school->city }}</div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="p-0 text-primary fw-bold">Escola:</div>
                    <div class="p-0">{{ $school->name }}</div>
                </div>
            </div>
            <div class="row gx-3 gy-3 mb-3">
                <div class="col-12 col-md-4">
                    <div class="p-0 text-primary fw-bold">Código MEC:</div>
                    <div class="p-0">{{ $school->inep }}</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="p-0 text-primary fw-bold">CNPJ:</div>
                    <div class="p-0">{{ $school->cnpj ?: 'N/A' }}</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="p-0 text-primary fw-bold">E-mail:</div>
                    <div class="p-0">{{ $school->email }}</div>
                </div>
            </div>
            <div class="row gx-3 gy-3 mb-3">
                <div class="col-12 col-md-6">
                    <div class="p-0 text-primary fw-bold">Telefone:</div>
                    <div class="p-0">{{ $school->phone ?: 'N/A' }}</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="p-0 text-primary fw-bold">Endereço:</div>
                    <div class="p-0">{{ $school->address }}</div>
                </div>
            </div>
            <div class="row gx-3 gy-3 mb-3">
                <div class="col-12 col-md-6">
                    <div class="p-0 text-primary fw-bold">Possui laboratório?</div>
                    <div class="p-0">{{ $school->has_lab ? 'Sim' : 'Não' }}</div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="p-0 text-primary fw-bold">Possui sala de recursos?</div>
                    <div class="p-0">{{ $school->has_resource_room ? 'Sim' : 'Não'}}</div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            @include('components.return-button')
        </div>
    </div>
@endsection
