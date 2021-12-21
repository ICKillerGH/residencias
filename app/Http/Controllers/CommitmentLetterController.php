<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommitmentLetterController extends Controller
{
    public function commitmentLetter(Request $request)
    {
        $userId = $request->user()->isStudent() ? Auth::id() : $request->user_id;

        $student = Student::query()
            ->withEmail()
            ->where('user_id', $userId)
            ->firstOrFail();
            
        $commitmentLetter = $student->commitmentLetter->exists()
            ? $student->commitmentLetter
            : $student->commitmentLetter()->create([
                'request_date' => now(),
                'company_id' => $student->company->id,
            ]);        
        $pdf = PDF::loadView('residency-process.commitment-letter',[
            'student'=>$student,
            'externalCompany' => $student->company,
            'commitmentLetter'=>$commitmentLetter,
        ]);
        return $pdf->stream('commitment-letter');
    }
}
