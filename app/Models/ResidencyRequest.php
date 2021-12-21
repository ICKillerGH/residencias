<?php

namespace App\Models;

use App\Models\Trait\ResidencyProcessDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidencyRequest extends Model
{
    use HasFactory, ResidencyProcessDocument;

    protected $guarded = [];

    protected $dates = ['request_date'];
}
