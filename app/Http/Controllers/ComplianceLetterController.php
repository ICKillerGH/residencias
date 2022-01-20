<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplianceLetterController extends Controller
{
    
    public function complianceLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();

        if (!$student->complianceLetter->exists && Auth::id() !== $student->user_id) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Solo el estudiante puede generar sus documento por primera vez',
            ]);
        }

        if (!$student->approvedPaperStructure){
            return redirect()->route('students.residencyProcess')->with('alert', [
                'type' => 'danger',
                'message' => 'Debe estar aprobada la estructura del informe final',
            ]);
        }
     
        $complianceLetter = $student->complianceLetter->exists
            ? $student->complianceLetter
            : $student->complianceLetter()->create([
                'request_date' => now(),
                'project_id' => $student->project->id,
                'company_id' => $student->company->id,

            ]);

        $pdf = PDF::loadView('residency-process.compliance-letter',[
            'student'=>$student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'complianceLetter'=> $complianceLetter,

        ]);

        return $pdf->stream('compliance-letter');
        
    }
}
