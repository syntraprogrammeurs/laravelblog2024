<?php

namespace App\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;
    public function render()
    {
        return view('livewire.contact-form');
    }
}
