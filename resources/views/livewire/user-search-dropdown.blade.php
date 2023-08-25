<div>
    <label for="userSelect">Select Users</label>
    <select id="userSelect" wire:model="selectedUsers" class="form-control" multiple>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
    <input type="text" wire:model="search" class="form-control mt-2" placeholder="Search users">
    <div class="mt-2">
        Selected Users: 
        @foreach ($selectedUsers as $selectedUser)
            {{ $selectedUser['name'] }}{{ !$loop->last ? ', ' : '' }}
        @endforeach
    </div>
</div>