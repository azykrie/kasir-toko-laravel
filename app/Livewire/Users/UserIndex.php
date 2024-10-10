<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('User')]
class UserIndex extends Component
{
    use WithPagination;

    public $name, $email, $password, $role, $user_id;
    public $isEditMode = false;
    public $search = '';
    protected $queryString = ['search'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . ($this->user_id ?? ''),
            'password' => $this->isEditMode ? 'sometimes|nullable|min:6' : 'required|min:6',
            'role' => 'required'
        ];
    }

    public function resetInput()
    {
        $this->reset(['name', 'email', 'password', 'role']);
    }

    public function resetFormCreate()
    {
        $this->resetInput();
        $this->isEditMode = false;
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);

        $this->isEditMode = false;
        $this->resetInput();

        $this->dispatch('close-modal');
        $this->dispatch('success', ['message' => 'User created successfully']);
    }

    public function editUser($user_id)
    {
        $users = User::findOrFail($user_id);
        $this->user_id = $users->id;
        $this->name = $users->name;
        $this->email = $users->email;
        $this->role = $users->role;
        $this->isEditMode = true;

    }

    public function updateUser()
    {
        $this->validate();

        $users = User::findOrFail($this->user_id);

        $users->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $users->password,
            'role' => $this->role,
        ]);

        $this->resetInput();

        $this->dispatch('close-modal');
        $this->dispatch('success', ['message' => 'User updated successfully']);
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        $this->dispatch('success', ['message' => 'User deleted successfully']);
    }
    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->latest()->paginate(10);

        return view('livewire.users.users-index', [
            'users' => $users
        ])->layout('components.layouts.main');
    }
}
