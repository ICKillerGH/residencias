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
            ->admin()
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
            return back()->withErrors(['email' => 'Ha ocurrido un error']);
        }

        return redirect()->route('admins.index')->with('alert', [
            'type' => 'success',
            'message' => 'El administrador se agrego correctamente',
        ]);
    }
}
