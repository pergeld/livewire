<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    public $username = '';
    public $about = '';

    public function mount()
    {
        //$this->username = auth()->user()->name;
        //$this->about = auth()->user()->email;

        $this->username = 'John';
        $this->about = 'Lorem ipsum set dolor.';
    }

    public function save()
    {
        $profileData = $this->validate([
            'username' => 'max:24',
            'about' => 'max:140',
        ]);

        //auth()->user()->update($profileData);

        $this->dispatchBrowserEvent('notify', 'Profile saved!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
