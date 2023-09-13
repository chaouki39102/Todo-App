<!-- Edit Task Model-->
<div wire:ignore class="modal fade" id="editTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editTaskModalLabel">
                        {{ __('Update a new task') }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <div class="container">
                                <select class="selectpicker" multiple>
                                    <option selected>Mustard</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                    @foreach ($allUsers as $user)
                                        <option value="{{ $user->id }}"
                                            @if (in_array($user->id, $selectedUsers)) selected @endif> {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="container px-0">
                                <label for="users" class="col-form-label">{{ __('Select collaborators:') }}</label>
                                <select class="selectpicker " multiple>
                                    @foreach ($allUsers as $user)
                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="container px-0">
                                <label for="categories" class="col-form-label">{{ __('Select categories:') }}</label>
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
                                <input wire:model="date_due" type="datetime-local" class="form-control " name="date_due"
                                    id="date_due">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">{{ __('Update Task') }}</button>
                    </div>
                </form>
            </div>
        </form>
    </div>
</div>
