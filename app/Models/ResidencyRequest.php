<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidencyRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['request_date'];

    /**
     * Accessors
     */
    public function getRequestDateFormattedAttribute()
    {
        return "{$this->request_date->day} de {$this->request_date->monthName} de {$this->request_date->year}";
    }
}
