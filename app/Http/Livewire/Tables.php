<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Tables extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.tables', [
            'transactions' => Transaction::paginate(10),
        ]);
    }
}
