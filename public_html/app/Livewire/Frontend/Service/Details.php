<?php

namespace App\Livewire\Frontend\Service;

use App\Models\Service;
use Livewire\Component;

class Details extends Component
{
    public $service;
    public $name;

    public function mount($service)
    {
        $this->service = Service::find($service)->first();
        $this->name = $this->service->name;
    }
    public function render()
    {
        return view('livewire.frontend.service.details');
    }
}
