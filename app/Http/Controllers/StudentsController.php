<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Career;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class StudentsController extends Controller
{
    public function index()
    {
        $students = User::with(['student.career'])->isStudent()->paginate();

        return view('students.index', [
            'students' => $students,
        ]);
    }

    public function create()
    {
        return view('students.create', [
            'careers' => Career::get(),
            'states' => Location::with(['locations.locations'])->state()->get(),
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->userData());

            $user->student()->create($request->studentData());

            DB::commit();
        } catch(Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('students.index')->with('alert', [
            'type' => 'success',
            'message' => 'El estudiante se agrego correctamente',
        ]);
    }
}
