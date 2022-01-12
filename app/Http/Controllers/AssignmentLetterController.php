<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class AssignmentLetterController extends Controller
{

    public function assignmentLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$student->assignmentLetter->exists() && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedAcceptanceletter){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de aceptaciòn',
            ]);
        }

        $assignmentLetter = $student->assignmentLetter->exists()
            ? $student->assignmentLetter
            : $student->assignmentLetter()->create([
                'request_date' => now(),
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.assignment-letter',[
            'student'=>$student,
            'externalCompany' => $student->company,
            'assignmentLetter'=> $assignmentLetter,

        ]);

        return $pdf->stream('assignment-letter');
    }
}
