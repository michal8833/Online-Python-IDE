@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">
        <div class="container mt-3 pl-3" style="height: 60px; margin-left: 90%;">
            <a href="{{ route('projects_create') }}" ><button type="button" class="btn btn-success">New project</button></a>
        </div>

        @if($projects->isEmpty())
            <p>You haven't created any project yet.</p>
        @else
        <div class="table-responsive">
            <table class="table align-items-center">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Created</th>
                    <th scope="col">Last change</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <th scope="row" >
                            <div class="media align-items-center">
                                <a href="#" class="avatar rounded-circle mr-3">
                                    <i class="ni ni-app"></i>
                                </a>
                                <div class="media-body">
                                    <span class="mb-0 text-sm">{{ $project->name }}</span>
                                </div>
                            </div>
                        </th>

                        <td>
                            {{ $project->description }}
                        </td>

                        <td>
                            {{ $project->created_at }}
                        </td>

                        <td>
                            {{ $project->updated_at }}
                        </td>

                        <td class="text-right">
                            <a href="{{ route('projects_show', $project) }}"><button type="button" class="btn btn-primary">View</button></a>
                            <a href="{{ route('projects_delete', $project) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        @endif

        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
