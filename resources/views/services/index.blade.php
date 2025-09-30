@extends('layouts.app')

@section('title', 'Listagem de Atendimentos')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class= "bg-white rounded-lg shadow-md overflow-hidden">
        <h2 class="text-primary mb-4">Lista de atendimentos realizados</h2>
        @include('services.components.filter')
        @include('services.components.service-table')
        @include('services.components.description-modal')
        @include('components.delete-modal')

        <div>
            {{ $services->links('pagination::bootstrap-5') }}
        </div>

        <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/show-service-description.js') }}"></script>
    <script src="{{ asset('js/select-school.js') }}"></script>
    <script>window.allSchools = @json($schools)</script>
    @include('show-toast')
@endpush







