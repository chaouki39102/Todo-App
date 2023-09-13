<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('task.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $dataValidated =  $request->validated();
        $dataValidated['created_by_id'] = userId();
        $dataValidated['category_id'] = 2;
        $user = User::find(userId());
        $user->tasks()->create($dataValidated)->categories()->attach([$dataValidated['category_id']]);
        Alert::success('success','Your task has been added successfully');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $task, $userId, $taskId )
    {
        $user = User::findOrFail($userId);
        $task = $user->tasks()->findOrFail($taskId);

        return view('tasks.edit', compact('user', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($taskId)
    {
        $user = User::findOrFail(userId());
        $task = $user->tasks()->findOrFail($taskId);
        // 'Not-Started'-> 'In-progress'-> 'Completed'
        if ($task->status === 'Not-Started') {
            $task->status = 'In-progress';
        } elseif ($task->status === 'In-progress')  {
            $task->status = 'Completed';
        } elseif ($task->status === 'Completed')  {
            Alert::info('Info','This task is completed');
        }

        $task->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Task = Task::findOrFail($id);
        $Task->users()->detach(); // Detach all users
        $Task->delete(); // Soft delete the post
        Alert::success('success','Task is deleted.');
        return redirect()->route('task.index');
    }
}
