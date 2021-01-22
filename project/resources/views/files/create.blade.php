@extends('layouts.app')

@section('navTitle',$project->name)
@section('navTitleRoute',route('projects_show',$project))
@section('file')

@section('content')

    <x-file-name-form
        method="POST"
        action="{{ route('projects.files.store',$project) }}"
        cancelRoute="{{ route('projects_show',$project) }}"
        submitText="Create"
        description="Create file."
    ></x-file-name-form>

@endsection
