@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3 ">
        <form action="{{route('projects')}}" method="GET">
            @csrf
            <div class="mt-6">
                <div class="row justify-content-lg-center">
                    <div class="col-md-6">
                        <div class="w-max py-2 px-1 text-center"><small>Create file.</small></div>
                        <input name='name' type="text" class="form-control form-control-alternative"
                               id="exampleFormControlInput1" placeholder="File name...">
                    </div>
                </div>

                <div class=" row justify-content-lg-center mt-4">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </div>
        </form>
    </div>
@endsection
