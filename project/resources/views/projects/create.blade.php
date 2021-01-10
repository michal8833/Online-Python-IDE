@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">

        <form method="post" action="{{ route('projects') }}">

            <div class="row" style="margin-left: 27%;margin-top: 5%;">
                <div class="col-md-6">
                    <div class="form-group">
                        <h2>Project name</h2>
                        <input type="text" placeholder="Name..." class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-left: 27%;margin-top: 2%;">
                <div class="col-md-6">
                    <div class="form-group">
                        <h2>Project description</h2>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description ..."></textarea>
                    </div>
                </div>
            </div>

        </form>



    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
