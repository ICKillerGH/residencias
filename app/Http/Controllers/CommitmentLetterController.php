<?php

namespace App\Http\Controllers;

use App\Enum\DocumentStatus;
use App\Models\CommitmentLetter;
use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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

    public function commitmentLetterCorrections(Request $request, Student $student)
    {
        $commitmentLetter = $student->inProcessCommitmentLetter;

        if (!$commitmentLetter) {
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
            $commitmentLetter->update([
                'status' => DocumentStatus::STATUS_NEEDS_CORRECTIONS,
            ]);

            $commitmentLetter->corrections()->create(['content' => $data['corrections']]);

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

    public function commitmentLetterMarkCorrectionsAsSolved ()
    {
        $commitmentLetter = CommitmentLetter::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();
    
        if (!$commitmentLetter->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de compromiso no necesita correciones',
            ]);
        }


        $commitmentLetter->status = DocumentStatus::STATUS_PROCESSING;

        $commitmentLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]); 
    }

    public function commitmentLetterMarkAsApproved(Student $student)
    {
        $commitmentLetter = $student->inProcessCommitmentLetter;

        if (!$commitmentLetter) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La carta de compromiso debe estar en proceso para porder ser revisada',
            ]);
        }

        $commitmentLetter->status = DocumentStatus::STATUS_APPROVED;

        $commitmentLetter->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La carta de compromiso ha sido aprovada',
        ]);
    }
}
