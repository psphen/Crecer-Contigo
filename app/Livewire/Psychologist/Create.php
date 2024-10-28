<?php

namespace App\Livewire\Psychologist;

use App\Models\City;
use App\Models\Gender;
use App\Models\PersonUser;
use App\Models\Psychologist;
use App\Models\State;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    //Save
    public $first_name;
    public $second_name;
    public $last_name;
    public $second_last_name;
    public $phone;
    public $dob;
    public $dni;
    public $gender_id;
    public $state_id;
    public $city_id;
    public $specialty;
    public $email;
    public $password;
    public $workDays = [];

    //Mount
    public $states;
    public $genders;
    public $cities;

    public function mount()
    {
        $this->states = State::all();
        $this->genders = Gender::all();
        $this->cities = City::all();
    }
    public function save()
    {
        // $this->validate();

        $user = new User();
        $user->name = $this->first_name.' '.$this->second_name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();

        $person = new PersonUser();
        $person->user_id = $user->id;
        $person->first_name = $this->first_name;
        $person->second_name = $this->second_name;
        $person->last_name = $this->last_name;
        $person->second_last_name = $this->second_last_name;
        $person->phone = $this->phone;
        $person->dob = $this->dob;
        $person->dni = $this->dni;
        $person->gender_id = $this->gender_id;
        $person->state_id = $this->state_id;
        $person->city_id = $this->city_id;
        $person->save();

        $psychologist = new Psychologist();
        $psychologist->person_id = $person->id;
        $psychologist->specialty = $this->specialty;
        $psychologist->work_days = json_encode($this->workDays);
        $psychologist->is_active = true;
        $psychologist->save();
    }
    public function render()
    {
        return view('livewire.psychologist.create');
    }
}
