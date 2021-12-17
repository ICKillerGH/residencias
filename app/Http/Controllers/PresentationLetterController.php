<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentationLetterController extends Controller
{

    public function presentationLetter()
    {
        $student = Student::query()
            ->withEmail()
            ->where('user_id', Auth::id())
            ->first();
        if (!$student->approvedResidencyRequest){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobado la peticion de residencia',
            ]);
        }
        $presentationLetter = $student->presentationLetter->exists()
            ? $student->presentationLetter
            : $student->presentationLetter()->create([
                'request_date' => now(),
            ]);

        $pdf = PDF::loadView('residency-process.presentation-letter',[
            'student'=>$student,
            'presentationLetter'=>$presentationLetter,
            
        ]);
        return $pdf->stream('presentation-letter');
    }
}
