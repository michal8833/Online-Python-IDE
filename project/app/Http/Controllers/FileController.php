<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\Project;

class FileController extends Controller
{
    function create(Project $project){
        return view('files.create')->withProject($project);
    }

    function store(FileRequest $request, Project $project){
        $file = new File();

        $file->name = $request->name;
        $file->project_id = $project->id;

        $file->save();

        return redirect()->route('projects');
    }
}
