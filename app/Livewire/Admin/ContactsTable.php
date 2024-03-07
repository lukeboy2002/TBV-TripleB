<?php

namespace App\Livewire\Admin;

use App\Models\Contact;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ContactsTable extends Component
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

    public function delete($id): void
    {
        $this->confirmingDeletion = $id;
    }

    public function deleteContact(Contact $contact)
    {
        $contact->delete();
        $this->confirmingDeletion = false;

        toastr()->success('Contact message has been deleted.', 'Delete Message');
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
        return view('livewire.admin.contacts-table', [
            'contacts' => Contact::search($this->search)
                ->orderBy($this->sortBy,$this->sortDir)
                ->paginate($this->perPage)
        ]);
    }
}
