@extends('layouts.app')

@section('navTitle',$project->name)
@section('navTitleRoute',route('projects_show',$project))

@include('files.files-navbar')

@section('content')

    <div class="container-fluid mt-3 col-12">
        <div class="card center" style="width: 36rem;">
            <div class="card-body text-center">
                <h4 class="card-title">Delete file</h4>
                <p class="card-text">Are you sure you want to delete file <span class="font-weight-bold">{{ $file->name }}</span> ?</p>
                <div>
                    <form method="post" action="{{route('projects_files_destroy', array($project, $file))}}" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary">Yes</button>
                    </form>
                    <form method="get" action="{{route('projects_show', $project)}}" class="d-inline-block">
                        <button class="btn btn-primary">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
