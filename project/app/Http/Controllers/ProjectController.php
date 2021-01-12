<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interpreter\PythonInterpreter;
use App\Models\Project;
use Illuminate\Http\Request;
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

    public function create() {
        return view('projects.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = Auth::id();
        $project->save();

        return redirect()->route('projects');
    }

    public function run(array $files) {
        $output = $this->pythonInterpreter->interpret($files);
        # TODO: display output on a view here
    }
}
