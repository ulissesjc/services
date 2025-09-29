@extends('layouts.app')

@section('title', 'Listagem de Usuários')

@section('content')
    <div class= "bg-white rounded-lg shadow-md overflow-hidden">
        <h2 class="text-primary">Lista de usuários</h2>
        @include('users.components.users-table')
        @include('components.delete-modal')

        <div>
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

        <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

    </div>
@endsection

@push('scripts')
    @include('show-toast')
@endpush
