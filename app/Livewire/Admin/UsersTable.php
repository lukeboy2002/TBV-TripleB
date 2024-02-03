<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $delete_id;

    #[Url(history:true)]
    public $search ='';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    public function updatedSearch(){
        $this->resetPage();
    }

    public $confirmingDeletion = false;
    public $confirmingForceDeletion = false;

    public function delete($id): void
    {
        $this->confirmingDeletion = $id;
    }

    public function forceDelete($id): void
    {
        $this->confirmingForceDeletion = $id;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        $this->confirmingDeletion = false;

        toastr()->success('User has been deleted.', 'Delete User');
    }

    public function ForceDeleteUser(Request $request, $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $profile_photo_path = $user->profile_photo_path;

        Storage::delete($profile_photo_path);

        $user->forceDelete();
        $this->confirmingForceDeletion = false;
        session()->flash('success', 'User deleted successfully');
    }

    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        return view('livewire.admin.users-table', [
            'users' => User::search($this->search)
                ->leftJoin('model_has_roles as role', 'id', '=', 'role.model_id')
                ->leftJoin('roles', 'role.role_id', '=', 'roles.id') // Join the roles table
                ->select('users.*', 'roles.name as role_name') // Select the role name
                ->orderBy($this->sortBy,$this->sortDir)
                ->withTrashed()
                ->paginate($this->perPage)
        ]);
    }
}
