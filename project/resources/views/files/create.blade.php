@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3 ">
        <div class="mt-6">
            <div class="row justify-content-lg-center mt-4">
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            </div>

            <form action="{{route('projects.files.store',$project)}}" method="post">
                @csrf

                <div class="row justify-content-lg-center">
                    <div class="col-md-6">
                        <div class="w-max py-2 px-1 text-center">Create file.</div>
                        <input name='name' type="text" class="form-control form-control-alternative"
                               id="exampleFormControlInput1" placeholder="File name...">
                    </div>
                </div>

                <div class=" row justify-content-lg-center mt-4">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>

            </form>
        </div>
    </div>
@endsection
