<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidencyRequestUploadSignedDocRequest;
use App\Models\ResidencyRequest;
use App\Models\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ResidencyProcessController extends Controller
{
    public function residencyProcess()
    {
        return view('students.residency-process', [
            'student' => Student::where('user_id', Auth::id())->firstOrFail(),
        ]);
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

        return $pdf->download('residency-request.pdf');
    }

    public function residencyRequestCorrections(Request $request, Student $student)
    {
        $residencyRequest = $student->inProcessResidencyRequest;

        if (!$residencyRequest) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia debe estar en proceso para porder ser revisada',
            ]);
        }

        $data = $request->validate([
            'corrections' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $residencyRequest->update([
                'status' => ResidencyRequest::STATUS_NEEDS_CORRECTIONS,
            ]);

            $residencyRequest->corrections()->create(['content' => $data['corrections']]);

            DB::commit();
        } catch (Throwable $t) {
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

    public function residencyRequestMarkCorrectionsAsSolved()
    {
        $residencyRequest = ResidencyRequest::query()
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$residencyRequest->needsCorrections()) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia no necesita correciones',
            ]);
        }

        $residencyRequest->status = ResidencyRequest::STATUS_PROCESSING;

        $residencyRequest->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Las correciones fueron verificadas',
        ]);
    }

    public function residencyRequestMarkAsApproved(Student $student)
    {
        $residencyRequest = $student->inProcessResidencyRequest;

        if (!$residencyRequest) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia debe estar en proceso para porder ser revisada',
            ]);
        }

        $residencyRequest->status = ResidencyRequest::STATUS_APPROVED;

        $residencyRequest->save();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'La petición de residencia ha sido aprovada',
        ]);
    }

    public function residencyRequestUploadSignedDoc(ResidencyRequestUploadSignedDocRequest $request, Student $student)
    {
        $residencyRequest = $student->approvedResidencyRequest;

        if (!$residencyRequest) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia debe aprovada',
            ]);
        }

        $residencyRequest->update($request->validated());

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El documento se subió con exitosamente',
        ]);
    }

    public function residencyRequestDownloadSignedDoc(Student $student)
    {
        $residencyRequest = $student->approvedResidencyRequest;

        if (!$residencyRequest) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'La petición de residencia debe aprovada',
            ]);
        }

        if (!$residencyRequest->signed_document) {
            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'El documento no ha sido cagado aún',
            ]);
        }

        return Storage::download($residencyRequest->signed_document);
    }
}
