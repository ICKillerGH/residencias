<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'user_id';

    /**
     * Scopes
     */
    public function scopeWithEmail($query)
    {
        return $query
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->select('teachers.*')
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
