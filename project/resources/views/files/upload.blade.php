@extends('layouts.app')

@section('navTitle',$project->name)
@section('navTitleRoute',route('projects_show',$project))

@include('files.files-navbar')

@section('content')
    <div class="container-fluid mt-3 ">
        <div class="mt-6">
            <div class="row justify-content-lg-center mt-4">
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>
            </div>

            <form action="{{route('projects_files_upload',$project)}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row justify-content-lg-center">
                    <div class="col-md-6">
                        <div class="py-2 px-1 text-center">Add files from your computer.</div>
                        <div class="row pt-4 justify-content-md-center">
                            <div class="col-sm-3">
                                <div id="browse" class="btn btn-primary mx-2"
                                     onclick="$('#fileInput').click()">
                                    Browse
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div id="fileMsg" class="form-control">No file Selected</div>
                                </div>
                            </div>
                        </div>
                        <input name='files[]' type="file" multiple style="height: 0; width: 0; overflow: hidden;"
                               id="fileInput" onchange="(function (){
                                   let fileList = $('#fileInput').prop('files');
                                   let msg = '';
                                   if(fileList.length === 1){
                                       msg = 'Selected: ' + fileList[0].name;
                                   }else if(fileList.length > 1){
                                       msg = 'Selected ' + fileList.length.toString() + ' files.';
                                   }
                                   $('#fileMsg').html(msg);
                               })()">
                    </div>
                </div>

                <div class=" row justify-content-lg-center mt-1">
                    <button class="btn btn-primary" type="submit">Upload</button>
                    <a class="btn btn-secondary ml-4" href="{{route('projects_show',$project)}}">Cancel</a>
                </div>

            </form>
        </div>
    </div>
@endsection
