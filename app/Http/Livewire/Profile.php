<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $username = '';
    public $about = '';
    public $birthday = null;
    public $newAvatar;
    public $files = [];

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
        $this->validate([
            'username' => 'max:24',
            'about' => 'max:140',
            'birthday' => 'sometimes',
            'newAvatar' => 'image|max:1000',
        ]);

        /*$filename = $this->newAvatar->store('/', 'avatars');

        auth()->user()->update([
            'username' => $this->username,
            'about' => $this->about,
            'birthday' => $this->birthday,
            'avatar' => $filename,
        ]);*/

        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
