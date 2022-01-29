<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class CompletionLetterController extends Controller
{
    public function completionLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$student->completionLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedQualificationletter) {
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la carta de calificación',
            ]);
        }

        $completionLetter = $student->completionLetter->exists
            ? $student->completionLetter
            : $student->completionLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,
            ]);

        $pdf = PDF::loadView('residency-process.completion-letter', [
            'student'=>$student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'completionLetter'=> $completionLetter,
        ]);

        return $pdf->stream('completion-letter');

    }
}
