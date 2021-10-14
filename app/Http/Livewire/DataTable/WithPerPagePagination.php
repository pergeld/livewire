<?php

namespace App\Http\Livewire\DataTable;

use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public $perPage = 3;

    public function applyPagination($query)
    {
        return $query->paginate($this->perPage);
    }
}