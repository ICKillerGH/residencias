<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class PreliminaryLetterController extends Controller
{

    public function preliminaryLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$student->preliminaryLetter->exists() && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

     

        $preliminaryLetter = $student->preliminaryLetter->exists()
            ? $student->preliminaryLetter
            : $student->preliminaryLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.preliminary-letter',[
            'student'=>$student,
            'externalCompany' => $student->company,
               'project' => $student->project,
            'preliminaryLetter'=> $preliminaryLetter,

        ]);

        return $pdf->stream('preliminary-letter');
        
    }
}
