<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class Tables extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'status' => '',
        'amount-min' => null,
        'amount-max' => null,
        'date-min' => null,
        'date-max' => null,
    ];
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
        $this->editing = $this->makeBlankTransaction();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function makeBlankTransaction()
    {
        return Transaction::make(['date' => now(), 'status' => 'Processing']);
    }

    public function create()
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankTransaction();

        $this->showEditModal = true;
    }

    public function edit(Transaction $transaction)
    {
        if ($this->editing->isNot($transaction)) $this->editing = $transaction;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function render()
    {
        return view('livewire.tables', [
            'transactions' => Transaction::query()
                ->when($this->filters['status'], fn($query, $status) => $query->where('status', $status))
                ->when($this->filters['amount-min'], fn($query, $amount) => $query->where('amount', '>=', $amount))
                ->when($this->filters['amount-max'], fn($query, $amount) => $query->where('amount', '<=', $amount))
                ->when($this->filters['date-min'], fn($query, $date) => $query->where('date', '>=', Carbon::parse($date)))
                ->when($this->filters['date-max'], fn($query, $date) => $query->where('date', '<=', Carbon::parse($date)))
                ->when($this->filters['search'], fn($query, $search) => $query->where('title', 'like', '%'.$search.'%'))
                ->orderBy('id', 'desc')
                ->paginate(10),
        ]);
    }
}
