<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::get();
        return view('task.index', compact('tasks'));
    }
}
