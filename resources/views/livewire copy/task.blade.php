<section style="background-color: #eee;">
    {{-- <section style="background-color: #212042;"> --}}
    <div class="container py-5 h-100">
        @if (session()->has('message'))
            <div class="alert alert-success text-center">{{ session('message') }}</div>
        @endif

        <div class="row d-flex justify-content-center">
            <div class="col-md-12 mt-5">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0 f/-white "><i class="fas fa-tasks me-2"></i>{{ __('Task List') }}</h5>

                        <div class="text-end ">
                            <button class="btn btn-primary" data-toggle="modal"
                                data-target="#AddTask">{{ __(' Add New Task') }}</button>
                        </div>
                    </div>
                    @if (!blank($tasks))
                        <div class="card-body " style="position: relative; height: auto">
                            <table class="table  mb-0">
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
                                            <td>
                                                @foreach ($task->users as $user)
                                                    <p class="d-inline-flex gap-0/">
                                                        {{-- <a class="btn btn-primary" data-bs-toggle="collapse"
                                                                href="#collapseExample" role="button"
                                                                aria-expanded="false" aria-controls="collapseExample">
                                                                Link with href
                                                            </a> --}}
                                                        @if ($task->created_by == $user->id)
                                                            <button class="btn " type="text"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseExample_{{ $task->id }}"
                                                                aria-expanded="false" aria-controls="collapseExample">
                                                                <span
                                                                class="badge badge-primary badge-pil1l">owner</span>
                                                                {{ $user->name }}
                                                                @if ( $task->users_count - 1 != 0)
                                                                    <span class="badge badge-secondary badge-pi1ll">{{ $task->users_count - 1 }} </span>
                                                                @endif
                                                            </button>
                                                    </p>
                                                @else
                                                    <div class="collapse " id="collapseExample_{{ $task->id }}">
                                                        <div
                                                            class=" d-flex justify-content-between align-items-center">
                                                            {{ $user->name }}
                                                        </div>
                                                    </div>
                                                @endif
                                    @endforeach
                                
                                    </td>

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
                                            <button wire:click="markTaskAsCompleted({{ $task->id }})" class="btn p-15" type="submit" style="width: 10px;">
                                                <i class="fas fa-check text-success me-3"></i>
                                            </button>
                                            <button class="btn p-15" style="width: 10px;"
                                                wire:click="editTask({{ $task->id }})">
                                                <i class="fas fa-pencil-alt text-primary  me-3"></i>
                                            </button>
                                            <button class="btn p-15" data-toggle="modal"
                                                data-target="#DeleteMsg"
                                                style="width: 10px;">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </button>

                                    </td>
                                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">{{ __('No task added yet!') }} </div>
                @endif
                <div class="card-footer text-end p-3">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#AddTask">
                        {{ __(' Add New Task') }} </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Start model add task --}}
    <div wire:ignore.self class="modal fade" tabindex="-1" id="AddTask" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="storeTask">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddTask">{{ __('Task Details') }}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="">
                            <label for="recipient-name" class="col-form-label">{{ __('Task:') }}</label>
                            @include('components.field', [
                                'type' => 'text',
                                'name' => 'title',
                                'placeholder' => 'Write your task title here',
                                'class' => '',
                            ])
                        </div>
                        <div class="">
                            <label for="description" class="col-form-label">{{ __('Description:') }}</label>
                            @include('components.field', [
                                'type' => 'textarea',
                                'name' => 'description',
                                'class' => '',
                            ])
                            {{-- <textarea class="form-control" name="description" id="message-text"></textarea> --}}
                        </div>
                        <div class="">
                            <div class="container px-0">
                                <label for="users" class="col-form-label">{{ __('Select collaborators:') }}</label>
                                <select wire:model="selectedUsers" class="selectpicker " multiple
                                    aria-label="size 5 select example">
                                    @foreach ($allUsers as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="container px-0">
                                <label for="categories" class="col-form-label">{{ __('Select categories:') }}</label>

                                <select wire:model="selectedCategories" class="selectpicker" multiple
                                    aria-label="size 3 select example">
                                    @foreach ($allCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between ">
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
                        </div class="w-50">
                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                        <script>
                            flatpickr("input[type=datetime-local]");
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" aria-label="Close"
                            class="btn btn-secondary">{{ __('Close') }}</button>
                        <button type="submit" aria-label="Close"
                            class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Start Form add New task --}}
    <div wire:ignore.self class="modal fade" id="idselct" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.live="storeStudentData">
                        <div class="form-group row">
                            <label for="student_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="student_id" class="form-control" wire:model="student_id">
                                @error('student_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-3">Name</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-3">Phone</label>
                            <div class="col-9">
                                <input type="number" id="phone" class="form-control" wire:model="phone">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Add Student</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Form add New task --}}

    {{-- Start Form msg del task --}}

    <div wire:ignore.self class="modal fade" tabindex="-1" id="DeleteMsg" tabindex="-1" data-backdrop="static"
        data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Are you sure you want to delete this task?') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            aria-label="Close">{{ __('No') }}</button>
                        <button wire:click="deleteTask({{ $task->id }})"  type="submit" class="btn btn-primary">{{ __('Yes') }}</button>
                    </div>
                </div>
            </div>
    </div>
    {{-- End Form add msg del task --}}
    </div>





</section>
{{-- 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
    integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}


<script script type="text/javascript">
    $(function() {
        $('.date_due').datetimepicker();
    });
</script>
@push('scripts')
    <script>
        $(function() {
            $('.date_due').datetimepicker();
        });
        window.addEventListener('close-modal', event => {
            $('#addTask').modal('hide');
            $('#DeleteMsg').modal('hide');
            ///$('#deleteStudentModal').modal('hide');
        });

        window.addEventListener('show-edit-student-modal', event => {
            $('#editStudentModal').modal('show');
        });

        window.addEventListener('show-delete-confirmation-modal', event => {
            $('#deleteStudentModal').modal('show');
        });

        window.addEventListener('show-view-student-modal', event => {
            $('#viewStudentModal').modal('show');
        });
    </script>
@endpush
