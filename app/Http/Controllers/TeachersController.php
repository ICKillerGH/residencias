<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Location;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class TeachersController extends Controller
{
    public function index()
    {
        $teachers = Teacher::query()
            ->withEmail()
            ->paginate();

        return view('teachers.index', [
            'teachers' => $teachers,
        ]);
    }
    
    public function create()
    {
        return view('teachers.create', [
            'states' => Location::with(['locations.locations'])->state()->get(),
        ]);
    }

    public function store(StoreTeacherRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->userData());

            $user->teacher()->create($request->teacherData());

            DB::commit();
        } catch(Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('teachers.index')->with('alert', [
            'type' => 'success',
            'message' => 'El profesor se agrego correctamente',
        ]);
    }

    public function destroy(Teacher $teacher)
    {
        User::destroy($teacher->user_id);

        return redirect()->route('teachers.index')->with('alert', [
            'type' => 'success',
            'message' => 'El profesor ha sido eliminado',
        ]);
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', [
            'teacher' => $teacher,
            'states' => Location::with(['locations.locations'])->state()->get(),
        ]);
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
          DB::beginTransaction();
        
        try {
            $teacher->update($request->teacherData());

            $teacher->user->update($request->userData());

            DB::commit();
        } catch(Throwable $t) {            
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('teachers.index')->with('alert', [
            'type' => 'success',
            'message' => 'El profesor ha sido actualizado',
        ]);
    }

}
