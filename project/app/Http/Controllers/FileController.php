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

        foreach ($request->file() as $_file){
            $file = new File();
            $file->project_id = $project->id;
            $file->name = $_file->getClientOriginalName();
            $file->content = base64_encode(file_get_contents($_file));
            $file->save();
        }

        return redirect()->route('projects_show',$project);
    }

    public function edit(Project $project, File $file){
        return view('files.edit')->withProject($project)->withFile($file);
    }

    public function save(Request $request, Project $project, File $file){

        $file->content = base64_encode($request->get('content'));

        $file->update();

        return redirect()->route('projects.files.edit',[$project,$file])->withSuccess('successfully saved');
    }
}
