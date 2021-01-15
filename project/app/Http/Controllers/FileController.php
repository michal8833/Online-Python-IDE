<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;

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

        return redirect()->route('projects_show',$project);
    }
    public function delete(Project $project, File $file) {

        return view('files.delete')->withProject($project)->withFile($file);
    }

    public function destroy(Project $project, File $file) {

        $file->delete();

        return redirect(route('projects_show', $project));
    }

    public function upload(Project $project) {
        return view('files.upload')->withProject($project);
    }

    public function uploadFiles(Request $request, Project $project){

        $request->validate([
           'files' => 'required|file'
        ]);

        return redirect()->route('projects_show',$project);
    }
}
