<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Task as ModelsTask;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Task extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $SelId, $taskId, $title, $description, $date_due, $priority, $status, $created_by_id, $category_id, $user;
    public $allCategories, $allUsers, $users;
    public $selectedCategories = [];
    public $selectedUsers = [];
    public $taskShow, $view_title, $view_description, $view_date_due, $view_priority, $view_status, $view_selectedCategories, $view_selectedUsers;
    public $search = '';

    protected $rules = [
        'title' => 'required|string|min:2|max:100',
        'description' => 'required|string|min:2|max:255',
        'date_due' => 'required|date|date_format:Y-m-d',
        'priority' => 'nullable|string|in:High,Medium,Low',
        'status' => 'nullable|string|in:Not-Started,In-progress,Completed',
    ];

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');

        return view(
            'livewire.task',
            [
                'tasks' => ModelsTask::where('title', 'like', '%' . $this->search . '%')
                    ->with('categories', 'users', 'createdBy')
                    ->withCount('users')->paginate(10)
            ]
        );
    }
    public function mount()
    {
        $this->allCategories = Category::all();
        $this->allUsers = User::get();
    }


    public function SelId($id)
    {
        $this->SelId = $id;
    }
    public function storeTask()
    {
        $dataValidated = $this->validate($this->rules);
        $dataValidated['status'] = 'Not-Started';
        $dataValidated['created_by'] = userId();
        $task = ModelsTask::create($dataValidated);
        // Attach team members
        $task->users()->attach(userId());
        $task->users()->attach($this->selectedUsers);
        // Attach categories
        $task->categories()->attach($this->selectedCategories);
        $this->resetFields();
        session()->flash('success', 'New task has been added successfully');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function updateTask()
    {

        $task = ModelsTask::where('title', 'like', '%' . $this->task->id . '%')
            ->with('categories', 'users', 'createdBy');
        $this->users = $task->users;
    }

    public function resetFields()
    {
        $this->taskId = null;
        $this->title = '';
        $this->description = '';
        $this->date_due = '';
        $this->priority = '';
        $this->status = '';
        $this->selectedCategories = [];
    }
    public function markTaskAsCompleted($taskId)
    {

        $task = ModelsTask::findOrFail($taskId);

        if ($task->status === 'Not-Started') {
            $task->update([
                'status' => 'In-progress',
            ]);
        } elseif ($task->status === 'In-progress') {
            $task->update([
                'status' => 'Completed',
            ]);
        } elseif ($task->status === 'Completed') {
            $task->update([
                'status' => 'Not-Started',
            ]);
        }
    }
    public function editTask()
    {
        //
    }
    public function showTask($taskId)
    {
        $taskShow = ModelsTask::findOrFail($taskId);
        $this->taskId = $taskShow->id;
        $this->title = $taskShow->title;
        $this->description = $taskShow->description;
        $this->date_due = $taskShow->date_due;
        $this->priority = $taskShow->priority;
        $this->status = $taskShow->status;
        $this->selectedUsers = $taskShow->users->pluck('id')->toArray();
        $this->selectedCategories = $taskShow->categories->pluck('id')->toArray();
        $this->dispatchBrowserEvent('show-edit-task-modal');
    }

    public $selectedIdForDelete;
    public function selcForDelete($id){
        $this->selectedIdForDelete = $id ;
    }
    public function deleteTask()
    {
        ModelsTask::where('created_by', authUser()->id)
        ->findOrFail((int) $this->selectedIdForDelete)
        ->delete();
        $this->dispatchBrowserEvent('close-modal');
    }
}
