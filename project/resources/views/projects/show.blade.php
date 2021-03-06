@extends('layouts.app')

@section('navTitle',$project->name)

@section('content')

    <div class="container-fluid mt-3">
        <div class="alert alert-success" role="heading">
            <div class="row">
                <h1 class="col d-inline-block">{{$project->name}}</h1>
                <div class="col d-inline-block">
                    <div class="row justify-content-end">
                        <div class="d-inline-block mx-2">
                            <a href="{{ route('projects_edit', $project) }}">
                                <button type="button" class="btn btn-primary">Edit</button>
                            </a>
                        </div>
                        <div class="d-inline-block mx-2">
                            <a href="{{ route('projects_index') }}">
                                <button type="button" class="btn btn-default">Back to projects</button>
                            </a>
                        </div>
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
                <div class="row mb-2">
                    <div class="col">
                        <h2 class="card-title d-inline-block">Files</h2>
                    </div>
                    <div class="col justify-content-end ">
                        <div class="row justify-content-end">
                            <a class="btn btn-success mx-2" href="{{ route('projects.files.create',$project) }}">New
                                File</a>
                            <a class="btn btn-success mx-2" href="{{ route('projects_files_upload',$project) }}">Upload
                                files</a>
                        </div>
                    </div>
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
                                        <th scope="row">
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
                                            <a href="{{ route('projects.files.edit',[$project,$file]) }}">
                                                <button name="editFile" type="button" class="btn btn-primary">Edit
                                                </button>
                                            </a>
                                            <a href="{{ route('projects_files_delete', array($project, $file)) }}">
                                                <button type="button" class="btn btn-danger">Delete</button>
                                            </a>
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
        <div class="py-6">
            <x-project-run-form
                action="{{ route('projects_run', $project) }}"
                activeCondition="{{ $project->files->isEmpty() }}"
            ></x-project-run-form>
            @if(session()->has('err'))
                <x-code-card
                    label="Errors:"
                    content="{{ session()->get('err') }}"
                    color="red"
                ></x-code-card>
            @endif
            @if(session()->has('output'))

                <x-code-card
                    label="{{ 'Process exited with code: '.($code ?? '<missing exit code>')}}"
                    content="{{ session()->get('output') }}"
                    color="white"
                ></x-code-card>
        </div>
        @endif

    </div>
@endsection


