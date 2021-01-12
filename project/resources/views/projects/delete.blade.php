@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3 col-12">
        <div class="card center" style="width: 36rem;">
            <div class="card-body text-center">
                <h4 class="card-title">Delete project</h4>
                <p class="card-text">Are you sure you want to delete project <span class="font-weight-bold">{{ $project->name }}</span>? All included files will be deleted too.</p>
                <div>
                    <a href="#" class="btn btn-primary">Yes</a>
                    <a href="#" class="btn btn-primary">No</a>
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
