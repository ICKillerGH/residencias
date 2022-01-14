<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;
    
    protected $guarded=[];

    /**
     * Accessors
     */
    public function getActivityScheduleImageUrlAttribute()
    {
        return Storage::url($this->attributes['activity_schedule_image']);
    }
}
