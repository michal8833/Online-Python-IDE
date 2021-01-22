@extends('layouts.app')

@section('navTitle',$project->name)
@section('navTitleRoute',route('projects_show',$project))

@section('content')

    <x-file-name-form
        method="PUT"
        action="{{route('projects_files_updateName',[$project,$file])}}"
        cancelRoute="{{route('projects.files.edit',[$project,$file])}}"
        submitText="Rename"
        description="Rename file"
        filename="{{$file->name}}"
    ></x-file-name-form>

@endsection
