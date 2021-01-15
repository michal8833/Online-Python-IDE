@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3 col-12">
        <div class="card center" style="width: 36rem;">
            <div class="card-body text-center">
                <h4 class="card-title">Delete project</h4>
                <p class="card-text">Are you sure you want to delete project <span class="font-weight-bold">{{ $project->name }}</span>? All included files will be deleted too.</p>
                <div>
                    <form method="post" action="{{route('projects_destroy', $project)}}" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary">Yes</button>
                    </form>
                    <form method="get" action="{{route('projects')}}" class="d-inline-block">
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
