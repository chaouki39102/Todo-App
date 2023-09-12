@extends('layouts.app')

@section('content0')
    <section style="background-color: #eee;">
        {{-- <section style="background-color: #212042;"> --}}
        <div class="container py-5 h-100">


            <div class="row d-flex justify-content-center">
                <div class="col-md-12 mt-5">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="mb-0 f/-white "><i class="fas fa-tasks me-2"></i>Task List</h5>

                            <div class="text-end ">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add
                                    Task</button>
                            </div>
                        </div>
                        <div class="card-body f/-white" style="position: relative; height: auto">

                            <table class="table f/-white mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Team Member') }}</th>
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
                                            @foreach ($task->users as $user)
                                                <th>
                                                    <img src="{{ getFile($user->avatar) }}"
                                                        class="shadow-1-strong rounded-circle" alt="avatar 1"
                                                        style="width: 55px; height: auto;">
                                                    <span class="ms-2">{{ $user->name }} </span>
                                            @endforeach
                                            </th>
                                            <td class="align-middle w-25">
                                                <span>{{ $task->title }} </span>
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
                                                    <span class="badge {{ $task->priority }}">{{ $task->priority }}</span>
                                                </h6>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex">
                                                    <form action="{{ route('task.update', $task->id) }} " method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn p-0" type="submit">
                                                            <i class="fas fa-check text-success me-3"></i>
                                                        </button>
                                                    </form>
                                                    {{-- Edit Button --}}
                                                    <div>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#editTaskModal">
                                                            Edit Task
                                                        </button>
                                                        <button wire:click="$emit('openEditModal')"
                                                            class="btn btn-primary">Edit</button>
                                                        {{-- //<form action="{{ route('task.edit', ['userId' => $user->id, 'taskId' => $task->id]) }} " method="post">
                                                        @csrf
                                                        <button class="btn p-0" type="submit">
                                                            <i class="fas fa-pencil-alt text-primary  me-3"></i>
                                                        </button>
                                                    </form> --}}
                                                        <button class="btn p-0" type="submit" data-bs-toggle="modal"
                                                            data-bs-target="#DeleteMsg">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </button>
                                                    </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-end p-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add
                                Task</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Start Form add msg del task --}}

            <div class="modal fade" tabindex="-1" id="DeleteMsg" role="dialog">
                <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Task</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{{ __('Are you sure you want to delete this task?') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('No') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('Yes') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- End Form add msg del task --}}

            {{-- Start Form add New task --}}
            <form action="{{ route('task.store') }} " method="post">
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('Task Details') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">{{ __('Task:') }}</label>
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
                                    ])
                                    {{-- <textarea class="form-control" name="description" id="message-text"></textarea> --}}
                                </div>
                                <div class="d-flex gap-5">
                                    <div>
                                        <label for="date_due" class="col-form-label  ">{{ __('Priority:') }}</label>
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

                                        <label for="date_due" class="col-form-label ">{{ __('Date:') }}</label>
                                        <input type="datetime-local" class="form-control " name="date_due">
                                    </div>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                <script>
                                    flatpickr("input[type=datetime-local]");
                                </script>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- End Form add New task --}}


        </div>
        <script type="text/javascript">
            $(function() {
                $('.datetimepicker').datetimepicker();
            });
        </script>


        <script>
            // Listen for the taskUpdated event
            Livewire.on('taskUpdated', () => {
                // Optionally, you can perform actions after task update
                // For example, refresh the task list
            });

            // Close the modal when requested
            Livewire.on('closeEditTaskModal', () => {
                $('#editTaskModal').modal('hide');
            });
        </script>
    </section>
@endsection
