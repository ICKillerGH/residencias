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

    public function state()
    {
        return $this->belongsTo(Location::class, 'state_id');
    }

    public function municipality()
    {
        return $this->belongsTo(Location::class, 'municipality_id');
    }

    public function locality()
    {
        return $this->belongsTo(Location::class, 'locality_id');
    }

    public function residencyRequest()
    {
        return $this->hasOne(ResidencyRequest::class, 'user_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'user_id');
    }

    /**
     * Scopes
     */
    public function scopeWithEmail($query)
    {
        return $query
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select('students.*')
            ->addSelect('users.email');
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
