@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">

        <x-auth-validation-errors class="mb-4" :errors="$errors" style="margin-left: 27%;margin-top: 5%;"/>

        <form method="post" action="{{ route('projects_update', $project) }}">
            @csrf
            @method('PUT')

            <div class="row" style="margin-left: 27%;margin-top: 5%;">
                <div class="col-md-6">
                    <div class="form-group">
                        <h2>Project name</h2>
                        <input type="text" placeholder="Name..." class="form-control" name="name" value="{{ $project->name }}"/>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-left: 27%;margin-top: 2%;">
                <div class="col-md-6">
                    <div class="form-group">
                        <h2>Project description</h2>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description ..." name="description">{{ $project->description }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-left: 27%;margin-top: 2%;">
                <div class="col-md-6">
                    <div class="form-group">
                        <button onclick="this.closest('form').submit();return false;" style="margin-top: 5%;width: 100%;" type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>

        </form>

        <div class="row" style="margin-left: 27%;margin-top: 2%;">
            <div class="col-md-6">
                <a href="{{ route('projects_show', $project) }}" ><button style="width: 100%;" type="button" class="btn btn-secondary">Cancel</button></a>
            </div>
        </div>

    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
