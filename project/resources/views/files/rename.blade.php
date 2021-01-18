@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3 ">
        <div class="mt-6">
            <div class="row justify-content-lg-center mt-4">
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            </div>

            <form action="{{route('projects_files_updateName',[$project,$file])}}" method="post">
                @csrf
                @method('PUT')

                <div class="row justify-content-lg-center">
                    <div class="col-md-6">
                        <div class="w-max py-2 px-1 text-center">Rename file.</div>
                        <input name='name' type="text" class="form-control form-control-alternative"
                               placeholder="File name..." value="{{ old('name') ?? $file->name }}">
                    </div>
                </div>

                <div class=" row justify-content-lg-center mt-4">
                    <button class="btn btn-primary" type="submit">Rename</button>
                    <a class="btn btn-secondary ml-4" href="{{route('projects.files.edit',[$project,$file])}}">Cancel</a>
                </div>

            </form>
        </div>
    </div>
@endsection
