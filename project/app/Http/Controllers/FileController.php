<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\File;

class FileController extends Controller
{
    public function delete(Project $project, File $file) {

        return view('files.delete')->withProject($project)->withFile($file);
    }

    public function destroy(Project $project, File $file) {

        $file->delete();

        return redirect(route('projects_show', $project));
    }
}
