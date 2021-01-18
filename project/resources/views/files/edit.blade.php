@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">
        <div class="px-2 mt-5">

            <div class="row justify-content-lg-center px-6 py-4">
                <form class="w-100" method="post" >
                    @csrf
                    <div class="alert alert-primary" role="heading">
                        <div class="row">
                            <h1 class="col-9 d-inline-block text-white">Editing {{$file->name}}</h1>
                            <div class="row d-inline-block">
                                <div class="d-inline-block justify-content-end" >
                                    <a class="btn btn-secondary mx-2" href="{{ route('projects_edit', $project) }}">Save</a>
                                </div>
                                <div class="d-inline-block">
                                    <a class="btn btn-secondary mx-2" href="{{ route('projects') }}" >Close</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <textarea spellcheck="false" class="form-control" rows="15" name="content">{{ base64_decode($file->content) }}</textarea>


                </form>

            </div>
        </div>
    </div>


@endsection
