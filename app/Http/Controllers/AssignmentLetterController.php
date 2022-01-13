<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\AssignmentLetter;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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

    public function assignmentLetterCorrections(Request $request, Student $student)
    {
        $assignmentLetter = $student->inProcessAssignmentLetter;

        if (!$assignmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de compromiso debe estar en proceso para poder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $assignmentLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $assignmentLetter->corrections()->create(['content' => $data['corrections']]);

            DB::commit();
        } catch(Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde',
            ]);
        }

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron envias correctamente',
        ]);
    }

    public function assignmentLetterMarkCorrectionsAsSolved()
    {
        $assignmentLetter = AssignmentLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$assignmentLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de asignación no necesita correciones',
            ]);
        }

        $assignmentLetter->status = DocumentStatus::STATUS_PROCESSING;

        $assignmentLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }
}
