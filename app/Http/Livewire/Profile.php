<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    public $saved = false;
    public $username = '';
    public $about = '';

    public function mount()
    {
        //$this->username = auth()->user()->name;
        //$this->about = auth()->user()->email;

        $this->username = 'John';
        $this->about = 'Lorem ipsum set dolor.';
    }

    public function updated($field)
    {
        if ($field !== 'saved') {
            $this->saved = false;
        }
    }

    public function save()
    {
        $profileData = $this->validate([
            'username' => 'max:24',
            'about' => 'max:140',
        ]);

        //auth()->user()->update($profileData);

        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
