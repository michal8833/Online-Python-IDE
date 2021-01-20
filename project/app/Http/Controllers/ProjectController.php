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

    public function index()
    {
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

        return redirect()->route('projects_show', $project);
    }

    public function show(Project $project) {

        return view('projects.show')->withProject($project);
    }

    public function edit(Project $project) {

        return view('projects.edit')->withProject($project);
    }

    public function update(Request $request, Project $project) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $project->name = $request->name;
        $project->description = $request->description;
        $project->update();

        return redirect()->route('projects_show', $project);
    }

    public function delete(Project $project) {

        return view('projects.delete')->withProject($project);
    }

    public function destroy(Project $project) {

        $project->delete();

        return redirect(route('projects_index'));
    }

    public function run(Request $request, Project $project) {
        $files = $project['files']->toArray();
        $result = $this->pythonInterpreter->interpret($files, $request['stdin'] ?? '', $request['args'] ?? '');

        return view('projects.show')
            ->with('project', $project)
            ->with('output', $result->getOutput())
            ->with('err', $result->getErrors())
            ->with('code', $result->getCode());
    }
}
