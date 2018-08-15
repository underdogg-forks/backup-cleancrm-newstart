<?php

namespace Modules\Core\Controllers\AdminCP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\Models\User;
use Modules\Core\Models\Role;
use Yajra\Datatables\Facades\Datatables;
use Modules\Core\Models\Permission;

class UsersController extends Controller
{
    //

    public function __construct()
    {
        //$this->middleware('role:users');
    }

    // Index Page for Users
    public function index()
    {
        $users = User::paginate(10);
        
        $params = [
            'title' => 'Users Listing',
            'users' => $users,
        ];

        return view('admincp.users.users_index')->with($params);
    }



    public function anyData()
    {
        $users = User::select(['id', 'name', 'email']);

        return Datatables::of($users)
            ->addColumn('link_to_user_name', function ($users) {
                return '<a href="#">' . $users->name . '</a>';
            })
            ->addColumn('email', function ($users) {
                return '<a href="users/' . $users->id . '" ">' . $users->email . '</a>';
            })
            ->addColumn('edit', '
                <a href="{{ route(\'users.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->addColumn('delete', '
                <form action="{{ route(\'users.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->rawColumns(['namelink', 'email', 'edit', 'delete'])
            ->make(true);
    }




    // Create User Page
    public function create()
    {
        $users = Role::all();

        $params = [
            'title' => 'Create User',
            'users' => $users,
        ];

        return view('admincp.users.users_create')->with($params);
    }

    // Store New User
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $role = Role::find($request->input('role_id'));

        $user->attachRole($role);

        return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been created.");
    }

    // Delete Confirmation Page
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            $params = [
                'title' => 'Confirm Delete Record',
                'user' => $user,
            ];

            return view('admincp.users.users_delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Editing User Information Page
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);

            //$users = Role::all();
            $users = Role::with('permissions')->get();
            $permissions = Permission::all();

            $params = [
                'title' => 'Edit User',
                'user' => $user,
                'users' => $users,
                'permissions' => $permissions,
            ];

            return view('admincp.users.users_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Update User Information to DB
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            $user->name = $request->input('name');
            $user->email = $request->input('email');

            $user->save();

            // Update role of the user
            $users = $user->users;

            foreach ($users as $key => $value) {
                $user->detachRole($value);
            }

            $role = Role::find($request->input('role_id'));

            $user->attachRole($role);

            // Update permission of the user
            //$permission = Permission::find($request->input('permission_id'));
            //$user->attachPermission($permission);

            return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Remove User from DB with detaching Role
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Detach from Role
            $users = $user->users;

            foreach ($users as $key => $value) {
                $user->detachRole($value);
            }

            $user->delete();

            return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
