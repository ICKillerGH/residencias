<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidencyProcessController extends Controller
{
    public function residencyProcess()
    {
        return view('students.residency-process');
    }

    public function residencyRequest()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->load(['student.residencyRequest', 'project', 'company']);

        if (!$user->project) {
            return redirect()->route('students.projectInfo')->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe cargar la data del proyecto',
            ]);
        }

        if (!$user->company) {
            return redirect()->route('students.companyInfo')->with('alert', [
                'type' => 'danger',
                'message' => 'El estudiante debe cargar la data de la compañia externa',
            ]);
        }

        if (!$user->student->residencyRequest) {
            $user->student->residencyRequest()->create([
                'request_date' => now(),
                'project_id' => $user->project->id,
                'company_id' => $user->id,
            ]);
        }

        $pdf = PDF::loadView('residency-process/residency-request', [
            'user' => $user,
            'externalCompany' => $user->company,
            'project' => $user->project,
            'residencyRequest' => $user->student->residencyRequest,
        ]);

        return $pdf->stream('residency-request.pdf');
    }
}
