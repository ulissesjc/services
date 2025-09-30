@extends('layouts.app')

@section('title', 'Listagem de Escolas')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class= "bg-white rounded-lg shadow-md overflow-hidden">
        <h2 class="text-primary">Lista de escolas</h2>
        @include('schools.components.filter')
        @include('schools.components.school-table')
        @include('components.delete-modal')

        <div>
            {{ $schools->links('pagination::bootstrap-5') }}
        </div>

        <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

    </div>
@endsection

@push('scripts')
    @include('show-toast')
@endpush
