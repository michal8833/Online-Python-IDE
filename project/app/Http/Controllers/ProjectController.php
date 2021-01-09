<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        //$books = Book::all();

        return view('projects.index');//->withBooks($books);
    }
}
