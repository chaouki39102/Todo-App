<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSearchDropdown extends Component
{
    public $search = '';
    public $selectedUsers = [];

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.user-search-dropdown', [
            'users' => $users,
        ]);
    }
}
