<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;


class UserIndex extends Component
{
    use WithPagination;

    public UserForm $form;
    public $role ="";
    public $search;
    public bool $usersModal = false;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->role= Role::all();
    }

    public function showModal()
    {
        $this->form->reset();
        $this->usersModal = true;
    }

    public function delete($id): void
    {
        $user = User::find($id)->delete();
    }

    public function save(): void
    {
        $this->form->store();
        $this->usersModal = false;
    }

    public array $sortBy = ['column' => 'id', 'direction' => 'desc'];

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->withAggregate('roles', 'name')
            ->orderBy(...array_values($this->sortBy))
            ->paginate(5);

        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1 rounded-sm'],
            ['key' => 'name', 'label' => __('Name')],
            ['key' => 'email', 'label' => __('Email')],
            ['key' => 'roles_name', 'label' => __('Roles')],
        ];
        return view('livewire.user-index', compact(['headers','users']));
    }


}
