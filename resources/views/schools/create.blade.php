@extends('layouts.app')

@section('title', 'Cadastrar Escola')

@section('content')
    <div class="container-fluid ps-4">
        <h3 class="text-primary">Cadastrar Escola</h3>
        <form class="d-flex flex-column" style="min-height: 85vh" action = "{{ route('school-store') }}" method="POST">
            @csrf
            @include('schools.components.school-form')
            @include('form-actions')
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"></script>
    <script src="{{ asset('js/mask.js') }}"></script>
@endpush

