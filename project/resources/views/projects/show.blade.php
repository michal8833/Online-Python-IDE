@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">
        <div class="alert alert-success" role="heading">
            <div class="row">
                <h1 class="col-9 d-inline-block">{{$project->name}}</h1>
                <div class="col-3 d-inline-block">
                    <div class="d-inline-block justify-content-end" style="height: 60px; margin-left: 20%;">
                        <a href="{{ route('projects_edit', $project) }}" ><button type="button" class="btn btn-primary">Edit</button></a>
                    </div>
                    <div class="d-inline-block" style="height: 60px; margin-left: 5px;">
                        <a href="{{ route('projects') }}" ><button type="button" class="btn btn-default">Back to projects</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Description</h2>
                <div class="card-text">{{$project->description}}</div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h2 class="card-title d-inline-block">Files</h2>
                <div class="d-inline-block" style="height: 60px; margin-left: 90%;">
                    <a href="{{ route('projects.files.create',$project) }}" ><button type="button" class="btn btn-success">New File</button></a>
                </div>
                <div class="card-text">
                    @if($project->files->isEmpty())
                        <p>You haven't added any files to this project yet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Last change</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->files as $file)
                                    <tr>
                                        <th scope="row" >
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                    <i class="ni ni-app"></i>
                                                </a>
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm">{{ $file->name }}</span>
                                                </div>
                                            </div>
                                        </th>

                                        <td>
                                            {{ $file->created_at }}
                                        </td>

                                        <td>
                                            {{ $file->updated_at }}
                                        </td>

                                        <td class="text-right">
                                            <a href="{{ route('projects') }}"><button type="button" class="btn btn-primary">Edit</button></a>
                                            <a href="{{ route('projects_files_delete', array($project, $file)) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div style="height: 60px;">
                    <a href="{{ route('projects') }}" >
                        <button type="button" class="btn btn-primary">
                            <h2 style="color: white;">Run Project</h2>
                        </button>
                    </a>
                </div>
                <div class="card-text mt-5">TODO: CLI and interpreter output</div>
            </div>
        </div>
    @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
