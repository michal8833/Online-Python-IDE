@extends('layouts.app')

@section('content')

    <x-file-name-form
        method="PUT"
        action="{{route('projects_files_storeAs',[$project,$file])}}"
        cancelRoute="{{route('projects.files.edit',[$project,$file])}}"
        submitText="Save as"
        description="Save file as."
        filename="{{$file->name}}"
    ></x-file-name-form>

@endsection
