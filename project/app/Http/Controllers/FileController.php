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
           'files' => 'required'
        ]);

        foreach ($request->file('files') as $_file){
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

        if($request->action == 'saveAs'){
            // save as
            session()->put('fileContent',$request->get('content'));
            return redirect()->route('projects_files_saveAs',[$project,$file]);
        }

        // save
        $file->content = base64_encode($request->get('content'));
        $file->update();

        return redirect()->route('projects.files.edit',[$project,$file])->withSuccess('successfully saved');
    }

    public function rename(Project $project, File $file){
        return view('files.rename')->withProject($project)->withFile($file);
    }

    public function updateName(FileRequest $request,Project $project, File $file){

        $file->name = $request->name;
        $file->update();

        return redirect()->route('projects.files.edit',[$project,$file])->withSuccess('Renamed successfully');
    }

    public function saveAs(Project $project, File $file){

        return view('files.save-as')->withProject($project)->withFile($file);
    }

    public function storeAs(FileRequest $request, Project $project, File $file){

        $files = $project->files()->where('name','=',$request->name)->first();

        if(!empty($files)){
            return redirect()->route('projects_files_saveAs',[$project, $file])
                    ->withErrors([$request->name.' file exist.']);
        }

        $newFile = new File();
        $newFile->project_id = $project->id;
        $newFile->name = $request->name;
        $newFile->content = base64_encode(session()->get('fileContent'));
        $newFile->save();

        return redirect()->route('projects.files.edit',[$project,$newFile])->withSuccess('Saved successfully');
    }
}
