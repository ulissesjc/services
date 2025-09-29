@extends('layouts.app')

@section('title', 'Escolas pendentes de atendimento')

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @include('schools.components.pending-schools-filter')
        <h3 class="text-primary">Lista de escolas cujo último atendimento foi há mais de {{ $months }} meses</h3>
        @include('schools.components.pending-schools-table')

        <div>
            {{ $schools->links('pagination::bootstrap-5') }}
        </div>

        <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

    </div>
@endsection

@push('scripts')
    @include('show-toast')
@endpush
