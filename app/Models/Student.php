<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'user_id';

    /**
     * Relationships
     */
    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    /**
     * Accessors
     */
    public function getSexTextAttribute()
    {
        return [
            'm' => 'Masculino',
            'f' => 'Femenino',
        ][$this->sex];
    }
}
