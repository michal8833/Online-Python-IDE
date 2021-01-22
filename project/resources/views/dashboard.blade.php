@extends('layouts.app')

@section('navTitle','Dashboard')

@section('content')

    <div class="container-fluid mt-3">
        <div class="container mt-3 pl-3">
            <div class="alert alert-primary" role="alert">
                <strong>You're logged in!</strong>
            </div>
        </div>



    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
