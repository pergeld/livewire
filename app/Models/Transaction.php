<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const STATUSES = [
        'Success' => 'Success',
        'Failed' => 'Failed',
        'Processing' => 'Processing',
    ];

    protected $guarded = [];
    protected $casts = ['date' => 'date'];

    public function getStatusColorAttribute()
    {
        return [
            'Processing' => 'indigo',
            'Success' => 'green',
            'Failed' => 'red',
        ][$this->status] ?? 'gray';
    }

    public function getDateForHumansAttribute()
    {
        return $this->date->format('M, d Y');
    }

    public function getDateForEditingAttribute()
    {
        return $this->date->format('m/d/Y');
    }

    public function setDateForEditingAttribute($value)
    {
        $this->date = Carbon::parse($value);
    }
}
