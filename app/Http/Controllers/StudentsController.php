<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentCompanyInfoRequest;
use App\Http\Requests\UpdateStudentPersonalInfo;
use App\Http\Requests\UpdateStudentProjectInfoRequest;
use App\Models\Career;
use App\Models\Company;
use App\Models\Location;
use App\Models\Project;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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
            'teachers' => Teacher::get(),
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
        } catch (Throwable $t) {
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

    public function personalInfo()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->load(['student.career', 'student.state']);

        return view('students.personal-info', [
            'user' => $user,
            'states' => Location::with(['locations.locations'])->state()->get()
        ]);
    }

    public function updatePersonalInfo(UpdateStudentPersonalInfo $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->student->update($request->validated());

        return redirect()->route('students.personalInfo')->with('alert', [
            'type' => 'success',
            'message' => 'La información se actualizo correctamente',
        ]);
    }

    public function companyInfo()
    {
        $company = Company::firstWhere('user_id', Auth::id()) ?? new Company();

        return view('students.company-info', [
            'company' => $company,
        ]);
    }

    public function updateCompanyInfo(UpdateStudentCompanyInfoRequest $request)
    {
        $userData = ['user_id' => Auth::id()];

        $company = Company::firstWhere($userData) ?? new Company($userData);

        $company->fill($request->validated());

        $company->save();

        return redirect()->route('students.companyInfo')->with('alert', [
            'type' => 'success',
            'message' => 'La información se actualizo correctamente',
        ]);;
    }

    public function projectInfo()
    {
        $project = Project::firstWhere('user_id', Auth::id()) ?? new Project();

        return view('students.project-info',[
            'project'=> $project,
        ] );
    }

    public function updateProjectInfo(UpdateStudentProjectInfoRequest $request)
    {
        $userData = ['user_id' => Auth::id()];

        $project = Project::firstWhere($userData) ?? new Project($userData);

        $data = $request->validated();

        if (!$project->exists() && !$request->activity_schedule_image) {
            throw ValidationException::withMessages([
                'activity_schedule_image' => 'La imagen del cronograma es requerida',
            ]);
        }

        $path = $request->activity_schedule_image->store('public/project');

        $data['activity_schedule_image'] = $path;

        $project->fill($data);

        $project->save();

        return redirect()->route('students.projectInfo')->with('alert', [
            'type' => 'success',
            'message' => 'La información se actualizo correctamente',
        ]);
    }
}
