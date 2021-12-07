<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidencyProcessController extends Controller
{
    public function residencyProcess()
    {
        return view('students.residency-process');
    }

    public function residencyRequest()
    {
        //
    }
}
