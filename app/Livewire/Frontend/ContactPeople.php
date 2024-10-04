<?php

namespace App\Livewire\Frontend;

use App\Models\Contact as ModelsContact;
use Livewire\Component;

class ContactPeople extends Component
{
    //Save
    public $name;
    public $phone;
    public $comment;

    protected function rules()
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
        ];

        return $rules;
    }
    public function closeAndClean()
    {
        $this->reset([
            'name',
            'phone',
            'comment',
        ]);
        $this->resetValidation([
            'name',
            'phone',
            'comment',
        ]);
    }
    public function save()
    {
        $this->validate();

        $contact = new ModelsContact();
        $contact->name = $this->name;
        $contact->phone = $this->phone;
        $contact->comment = $this->comment;
        $contact->save();
        
        $this->emit('alert',__('Registered City!'));
        $this->closeAndClean();
    }
    public function render()
    {
        return view('livewire.frontend.contact-people');
    }
}
