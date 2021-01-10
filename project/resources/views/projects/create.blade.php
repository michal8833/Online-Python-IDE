@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">

        <form method="post" action="{{ route('projects_store') }}">

            @csrf

            <div class="row" style="margin-left: 27%;margin-top: 5%;">
                <div class="col-md-6">
                    <div class="form-group">
                        <h2>Project name</h2>
                        <input type="text" placeholder="Name..." class="form-control" name="name" :value="old('name')"/>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-left: 27%;margin-top: 2%;">
                <div class="col-md-6">
                    <div class="form-group">
                        <h2>Project description</h2>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description ..." name="description" :value="old('description  ')"></textarea>
                    </div>
                </div>
            </div>

            <x-button class="btn btn-primary" style="margin-left: 27%;margin-top: 2%;height: 50px;">
                Create
            </x-button>


        </form>

        <a style="margin-left: 27%;margin-top: 5%;"><button type="button" class="btn btn-secondary">Cancel</button></a>

    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
