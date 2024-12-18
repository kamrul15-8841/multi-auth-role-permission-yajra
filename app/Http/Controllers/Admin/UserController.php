<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    //    this function handle edit and delete from users/partials/actions.blade.php
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles')->select('users.*');
            return DataTables::of($users)
                ->addColumn('roles', function ($user) {
                    return $user->roles->pluck('name')->join(', ');
                })
                ->addColumn('actions', function ($user) {
                    return view('admin.users.partials.actions', compact('user'))->render();
                })
                ->rawColumns(['roles', 'actions'])
                ->make(true);
        }

        return view('admin.users.index');
    }
//    this function handle edit and delete of interface also
    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->get();
            return DataTables::of($data)
                ->addColumn('roles', function ($row) {
                    return $row->roles->pluck('name')->join(', ');
                })
                ->addColumn('actions', function ($row) {
                    $editUrl = route('users.edit', $row->id);
                    $deleteUrl = route('users.destroy', $row->id);
                    return "
                    <a href='{$editUrl}' class='btn btn-sm btn-warning'>Edit</a>
                    <form action='{$deleteUrl}' method='POST' style='display:inline-block;'>
                        " . csrf_field() . method_field('DELETE') . "
                        <button type='submit' class='btn btn-sm btn-danger'>Delete</button>
                    </form>
                ";
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'roles' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->roles);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required',
        ]);

        $user->update($request->only('name', 'email'));
        $user->syncRoles($request->roles);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
