<div>
    <section style="background-color: #eee;">
        <div class="container py-5 h-100">
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 mt-5">
                    <div class="mb-3">
                        <input wire:model="search" class="form-control" type="search" name="search" id="search"
                            placeholder="Type your search here...">
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mb-0 "><i class="fas fa-tasks me-2"></i>{{ __('Task List') }}</h5>

                            <div class="text-end ">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addTaskModel">{{ __(' Add New Task') }}</button>
                            </div>
                        </div>
                        @if (!blank($tasks))
                            <div class="card-body " style="position: relative; height: auto">
                                <table class="table  mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('Team Member1') }}</th>
                                            <th scope="col">{{ __('Task') }}</th>
                                            <th scope="col">{{ __('Date Due') }}</th>
                                            <th scope="col">{{ __('Progress') }}</th>
                                            <th scope="col">{{ __('Priority') }}</th>
                                            <th scope="col">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr class="fw-normal">
                                                <td>
                                                    @foreach ($task->users as $user)
                                                        @if ($task->created_by == $user->id)
                                                            <p class="d-inline-flex m-auto">
                                                                <a class="btn btn-light" data-bs-toggle="collapse"
                                                                    href="#collapseExample_{{ $task->id }}"
                                                                    role="button" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                    <span class="badge Completed">Owner
                                                                    </span>
                                                                    {{ $user->name }}
                                                                    @if ($task->users_count - 1 != 0)
                                                                        <span
                                                                            class="badge Completed">{{ $task->users_count - 1 }}</span>
                                                                    @endif
                                                                </a>

                                                            </p>
                                                        @else
                                                            <div class="collapse "
                                                                id="collapseExample_{{ $task->id }}">
                                                                <div
                                                                    class=" d-flex justify-content-between align-items-center">
                                                                    {{ $user->name }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                </td>
                                                <td class="align-middle w-25">
                                                    <span wire:click="showTask({{ $task->id }})" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                        aria-controls="staticBackdrop">{{ $task->title }} </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>{{ $task->date_due }} </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="badge {{ $task->status }}">{{ str_replace('-', ' ', $task->status) }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <h6 class="mb-0">
                                                        <span
                                                            class="badge {{ $task->priority }}">{{ $task->priority }}</span>
                                                    </h6>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex">
                                                        <button wire:click="markTaskAsCompleted({{ $task->id }})"
                                                            class="btn p-15" type="submit">
                                                            @if($task->status === 'Not-Started')
                                                            <i class="fas fa-power-off text-danger"></i>
                                                            @elseif($task->status === 'In-progress')
                                                            <i class="fas fa-power-off text-success"></i>
                                                            @elseif($task->status === 'Completed')
                                                            <i class="fas fa-check text-success"></i>
                                                            @endif
                                                        </button>
                                                        <button class="btn p-15"
                                                            wire:click="showTask({{ $task->id }})">
                                                            <i class="fas fa-pencil-alt text-primary "></i>
                                                        </button>
                                                        <button wire:click="selcForDelete({{ $task->id }})" class="btn p-15" onclick="$('#deleteStudentModal').modal('show')">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </button>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning text-center">{{ __('No task added yet!') }} </div>
                        @endif
                        <div class="card-footer text-end d-flex justify-content-between  p-3">
                            {{ $tasks->links() }}
                            <button class="btn btn-primary h-100" data-bs-toggle="modal" data-bs-target="#addTaskModel"
                                aria-controls="addTaskModel">
                                {{ __(' Add New Task') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Task Model-->
        <div wire:ignore.self class="modal fade" id="editTaskModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editTaskModalLabel">
                            {{ __('Update a new task') }}
                        </h1>
                        <button wire:click="resetFields()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="updateTask">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id" class="col-form-label">{{ __('Task id:') }}</label>
                                @include('components.field', [
                                    'type' => 'text',
                                    'name' => 'taskId',
                                    'placeholder' => '',
                                    'class' => '',
                                ])
                            </div>
                            <div class="mb-3">
                                <label for="title" class="col-form-label">{{ __('Task title:') }}</label>
                                @include('components.field', [
                                    'type' => 'text',
                                    'name' => 'title',
                                    'placeholder' => 'Write your task title here',
                                    'class' => '',
                                ])
                            </div>
                            <div class="mb-3">
                                <label for="description" class="col-form-label">{{ __('Description:') }}</label>
                                @include('components.field', [
                                    'type' => 'textarea',
                                    'name' => 'description',
                                    'class' => '',
                                    'value' => '{{ $view_description }}',
                                ])
                            </div>
                            <div class="mb-3">
                                <div class="container px-0">
                                    <label for="users"
                                        class="col-form-label">{{ __('Select collaborators:') }}</label>
                                    <select wire:model="selectedUsers" class="selectpicker " multiple>
                                        @foreach ($allUsers as $user)
                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="container px-0">
                                    <label for="categories"
                                        class="col-form-label">{{ __('Select categories:') }}</label>
                                    <select class="selectpicker" wire:model="selectedCategories"  multiple>
                                        <option selected>Category</option>
                                        @foreach ($allCategories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (in_array($category->id, $selectedCategories)) selected @endif>
                                                {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between gap-2 ">
                                <div class="w-50">
                                    <label for="priority" class="col-form-label">{{ __('Priority:') }}</label>
                                    @include('components.field', [
                                        'class' => '',
                                        'type' => 'select',
                                        'name' => 'priority',
                                        'options' => [
                                            'High' => __('High'),
                                            'Medium' => __('Medium'),
                                            'Low' => __('Low'),
                                        ],
                                        'placeholder' => __('Priority'),
                                    ])
                                </div>
                                <div>
                                    <label for="date_due" class="col-form-label">{{ __('Date:') }}</label>
                                    <input wire:model="date_due" type="datetime-local" class="form-control "
                                        name="date_due" id="date_due">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button wire:click="resetFields()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">{{ __('Update Task') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Task Model-->
        <div wire:ignore class="modal fade" id="addTaskModel" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="addTaskModelLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="storeTask">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addTaskModelLabel">{{ __('Add a new task') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">{{ __('Task title:') }}</label>
                                @include('components.field', [
                                    'type' => 'text',
                                    'name' => 'title',
                                    'placeholder' => 'Write your task title here',
                                    'class' => '',
                                    'value' => '{{ $view_title }}',
                                ])
                            </div>
                            <div class="mb-3">
                                <label for="description" class="col-form-label">{{ __('Description:') }}</label>
                                @include('components.field', [
                                    'type' => 'textarea',
                                    'name' => 'description',
                                    'class' => '',
                                    'value' => '{{ $view_description }}',
                                ])
                            </div>
                            <div class="mb-3">
                                <div class="container px-0">
                                    <label for="users"
                                        class="col-form-label">{{ __('Select collaborators:') }}</label>
                                    <select wire:model="selectedUsers" class="selectpicker " multiple
                                        aria-label="size 5 select example">
                                        @foreach ($allUsers as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="container px-0">
                                    <label for="categories"
                                        class="col-form-label">{{ __('Select categories:') }}</label>
                                    <select wire:model="selectedCategories" class="selectpicker" multiple
                                        aria-label="size 3 select example">
                                        @foreach ($allCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between gap-2 ">
                                <div class="w-50">
                                    <label for="priority" class="col-form-label">{{ __('Priority:') }}</label>
                                    @include('components.field', [
                                        'class' => '',
                                        'type' => 'select',
                                        'name' => 'priority',
                                        'options' => [
                                            'High' => __('High'),
                                            'Medium' => __('Medium'),
                                            'Low' => __('Low'),
                                        ],
                                        'placeholder' => __('Priority'),
                                    ])
                                </div>
                                <div>
                                    <label for="date_due" class="col-form-label">{{ __('Date:') }}</label>
                                    <input wire:model="date_due" type="datetime-local" class="form-control "
                                        name="date_due" id="date_due">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">{{ __('Add Task') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div wire:ignore.self class="modal fade" id="deleteStudentModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="deleteStudentModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteStudentModal">
                    {{ __('Update a new task') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure ? this delete will be permanent !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button wire:click="deleteTask()" type="button" data-bs-dismiss="modal" class="btn btn-danger">{{ __('Delete') }}</button>
            </div>
        </div>
    </div>
</div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            window.addEventListener('close-modal', event => {
                $('#addTaskModel').modal('hide');
                $('#DeleteMsg').modal('hide');
            });

            window.addEventListener('show-edit-task-modal', event => {
                $('#editTaskModal').modal('show');
            });

            window.addEventListener('show-delete-confirmation-modal', event => {
                $('#deleteStudentModal').modal('show');
            });

            window.addEventListener('show-view-student-modal', event => {
                $('#viewStudentModal').modal('show');
            });
        </script>

        <script>
            flatpickr("input[type=datetime-local]");
        </script>

        <script>
            window.addEventListener('contentChanged', event => {
                $('.selectpicker').selectpicker();
            });
        </script>
    @endpush

</div>
