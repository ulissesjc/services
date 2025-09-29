@extends('layouts.app')

@section('title', 'Cadastrar Atendimento')

@section('content')
    <div class="container-fluid ps-4">
        <h3 class="text-primary">Cadastrar Atendimento</h3>
        <form class="d-flex flex-column" style="min-height: 85vh" action = "{{ route('service-store') }}" method="POST">
            @csrf
            @include('services.components.service-form')
            @include('form-actions')
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/select-school.js') }}"></script>
    <script>window.allSchools = @json($schools)</script>
@endpush

