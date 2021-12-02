<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required|max:255',
            'fathers_last_name' => 'required|max:255',
            'mothers_last_name' => 'required|max:255',
            'career_id' => 'required|exists:careers,id',
            'account_number' => 'required|max:255',
            'sex' => 'required|in:m,f',
            'curp' => 'required|max:18|unique:students,curp',
            'career_percentage' => 'required|numeric|min:0|max:100',
            'phone_number' => 'required|numeric|digits:10',
            'state_id' => 'required|exists:locations,id',
            'municipality_id' => 'required|exists:locations,id',
            'locality_id' => 'required|exists:locations,id',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function userData()
    {
        return [
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => User::STUDENT_ROLE,
        ];
    }

    public function studentData()
    {
        return array_merge(
            Arr::except($this->validated(), ['email', 'password']),
            [
                'is_enrolled' => $this->filled('is_enrolled'),
                'is_social_service_concluded' => $this->filled('is_social_service_concluded'),
            ]
        );
    }
}
