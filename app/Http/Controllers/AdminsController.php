<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = User::query()
            ->with(['admin'])
            ->isAdmin()
            ->paginate();

        return view('admins.index', [
            'admins' => $admins,
        ]);
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(StoreAdminRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->userData());

            $user->admin()->create($request->adminData());

            DB::commit();
        } catch(Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('admins.index')->with('alert', [
            'type' => 'success',
            'message' => 'El administrador se agrego correctamente',
        ]);
    }
    public function destroy(Admin $admin)
    {
        User::destroy($admin->user_id);

        return redirect()->route('admins.index')->with('alert', [
            'type' => 'success',
            'message' => 'El administrador ha sido eliminado',
        ]);
    }
}
