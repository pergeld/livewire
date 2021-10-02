<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Tables extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.tables', [
            'transactions' => Transaction::search('title', $this->search)->paginate(10),
        ]);
    }
}
