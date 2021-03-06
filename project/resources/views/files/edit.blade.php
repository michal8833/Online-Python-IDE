@extends('layouts.app')

@section('navTitle',$project->name)
@section('navTitleRoute',route('projects_show',$project))

@include('files.files-navbar')

@section('content')

    <div class="container-fluid mt-3">
        <div class="px-2 mt-5">
            <div class="row justify-content-lg-center px-6 py-4">

                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--text"><strong>{{ $file->name }}</strong> {{session()->get('success')}}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form id="form" class="w-100" method="post" action="{{ route('projects_files_save', [$project,$file]) }}">
                    @csrf
                    @method('PUT')
                    <div class="alert alert-primary" role="heading">
                        <div class="row">
                            <div class="col">
                                <h2 class="d-inline-block text-white">Editing {{$file->name}}</h2>
                            </div>
                            <div class="col">
                                <div class="row justify-content-end">
                                    <div class="d-inline-block">
                                        <a class="btn btn-secondary mx-2" href="{{ route('projects_files_rename',[$project,$file]) }}">Rename</a>
                                    </div>
                                    <div class="d-inline-block ">
                                        <button name="action" value="save" type="submit" class="btn btn-secondary mx-2">Save</button>
                                    </div>
                                    <div class="d-inline-block">
                                        <button name="action" value="saveAs" type="submit" class="btn btn-secondary mx-2">Save as</button>
                                    </div>
                                    <div class="d-inline-block">
                                        <a class="btn btn-secondary mx-2"
                                           href="{{ route('projects_show',$project) }}">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <textarea id="codeEditor" spellcheck="false" class="form-control" rows="15" name="content">{{ base64_decode($file->content) }}</textarea>


                </form>

            </div>
        </div>
    </div>

    <script>

        document.getElementById('codeEditor').addEventListener('keydown', function (event) {
            if (event.key === 'Tab') {
                event.preventDefault();
                let start = this.selectionStart;
                let end = this.selectionEnd;

                this.value = this.value.substring(0, start) +
                    "\t" + this.value.substring(end);

                this.selectionStart =
                    this.selectionEnd = start + 1;
            }
        })
    </script>

@endsection
