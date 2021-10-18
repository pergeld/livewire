<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    public $username = '';
    public $about = '';
    public $birthday = null;

    public function mount()
    {
        //$this->username = auth()->user()->name;
        //$this->about = auth()->user()->email;

        $this->username = 'John';
        $this->about = 'Lorem ipsum set dolor.';
        $this->birthday = now()->format('m/d/Y');
    }

    public function save()
    {
        $profileData = $this->validate([
            'username' => 'max:24',
            'about' => 'max:140',
            'birthday' => 'sometimes'
        ]);

        //auth()->user()->update($profileData);

        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
