@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">
        <div class="container mt-3 pl-3" style="height: 60px; margin-left: 90%;">
            <button type="button" class="btn btn-success">New project</button>
        </div>

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
                <tr>
                    <th scope="row" >
                        <div class="media align-items-center">
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="../../assets/img/theme/bootstrap.jpg">
                            </a>
                            <div class="media-body">
                                <span class="mb-0 text-sm">Project name</span>
                            </div>
                        </div>
                    </th>

                    <td>
                        Some description
                    </td>

                    <td>
                        02.03.2020
                    </td>

                    <td>
                        08.12.2020
                    </td>

                    <td class="text-right">
                        <button type="button" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </td>
                </tr>

                </tbody>
            </table>

        </div>




        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
