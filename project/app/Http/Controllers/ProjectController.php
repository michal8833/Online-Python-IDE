<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interpreter\PythonInterpreter;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    private PythonInterpreter $pythonInterpreter;

    public function __construct() {
        $this->pythonInterpreter = new PythonInterpreter();
    }

    public function index() {
        $projects = Project::where('user_id', Auth::id())->get();

        return view('projects.index')->withProjects($projects);
    }

    public function destroy(Project $project) {

        $project->delete();

        return redirect(route('projects.index'));
    }

    public function run(array $files) {
        $output = $this->pythonInterpreter->interpret($files);
        # TODO: display output on a view here
    }
}
