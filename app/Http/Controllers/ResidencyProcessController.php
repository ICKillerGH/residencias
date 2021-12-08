<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class ResidencyProcessController extends Controller
{
    public function residencyProcess()
    {
        return view('students.residency-process');
    }

    public function residencyRequest()
    {
        $student = Student::query()
            ->withEmail()
            ->with(['residencyRequest', 'project', 'company'])
            ->where('user_id', Auth::id())
            ->first();

        if (!$student->project) {
            return redirect()->route('students.projectInfo')->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe cargar la data del proyecto',
            ]);
        }

        if (!$student->company) {
            return redirect()->route('students.companyInfo')->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe cargar la data de la compañia externa',
            ]);
        }

        $residencyRequest = $student->residencyRequest ?? $student->residencyRequest()->create([
            'request_date' => now(),
            'project_id' => $student->project->id,
            'company_id' => $student->company->id,
        ]);

        $pdf = PDF::loadView('residency-process.residency-request', [
            'student' => $student,
            'externalCompany' => $student->company,
            'project' => $student->project,
            'residencyRequest' => $residencyRequest,
        ]);

        return $pdf->stream('residency-request.pdf');
    }
}
