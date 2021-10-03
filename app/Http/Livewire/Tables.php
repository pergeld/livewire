<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Tables extends Component
{
    use WithPagination;

    public $search = '';
    public $showEditModal = false;
    public Transaction $editing;

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.amount' => 'required',
            'editing.status' => 'required|in:'.collect(Transaction::STATUSES)->keys()->implode(','),
            'editing.date_for_editing' => '',
        ];
    }

    public function mount()
    {
        $this->editing = Transaction::make(['date' => now()]);
    }

    public function edit(Transaction $transaction)
    {
        $this->editing = $transaction;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.tables', [
            'transactions' => Transaction::search('title', $this->search)->paginate(10),
        ]);
    }
}
