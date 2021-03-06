<?php

namespace Modules\Core\Controllers\AdminCP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Permission;
use Yajra\Datatables\Facades\Datatables;
use Modules\Core\Models\Role;
use Modules\Core\Repositories\RolesRepository;

class RolesController extends Controller
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RolesRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }


    /**
     * Display a listing of the Role.
     *
     * @param RoleDataTable $roleDataTable
     * @return Response
     */
    public function index()
    {
        return view('admincp.roles.roles_index');
    }


    public function anyData()
    {
        $roles = Role::select(['id', 'name', 'display_name', 'description']);

        return Datatables::of($roles)
            ->addColumn('namelink', function ($roles) {
                return '<a href="#">' . $roles->name . '</a>';
            })
            ->addColumn('display_name', function ($roles) {
                return '<a href="roles/' . $roles->id . '" ">' . $roles->display_name . '</a>';
            })
            ->addColumn('description', function ($roles) {
                return '<a href="roles/' . $roles->id . '" ">' . $roles->description . '</a>';
            })
            ->addColumn('edit', '
                <a href="{{ route(\'roles.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->addColumn('delete', '
                <form action="{{ route(\'roles.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->rawColumns(['namelink', 'display_name', 'description', 'edit', 'delete'])
            ->make(true);
    }


    // Roles Creation Page
    public function create()
    {
        //
        $permissions = Permission::all();

        $params = [
            'title' => 'Create Roles',
            'permissions' => $permissions,
        ];

        return view('admincp.roles.roles_create')->with($params);
    }

    // Roles Store to DB
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('roles.index')->with('success',
            "The role <strong>$role->name</strong> has successfully been created.");
    }

    // Roles Delete Confirmation Page
    public function show($id)
    {
        //
        try {
            $role = Role::findOrFail($id);

            $params = [
                'title' => 'Delete Role',
                'role' => $role,
            ];

            return view('admincp.roles.roles_delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Roles Editing Page
    public function edit($id)
    {
        //
        try {
            $role = Role::findOrFail($id);
            $permissions = Permission::all();
            $role_permissions = $role->permissions()->get()->pluck('id')->toArray();

            $params = [
                'title' => 'Edit Role',
                'role' => $role,
                'permissions' => $permissions,
                'role_permissions' => $role_permissions,
            ];

            return view('admincp.roles.roles_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Roles Update to DB
    public function update(Request $request, $id)
    {
        //
        try {
            $role = Role::findOrFail($id);

            $this->validate($request, [
                'display_name' => 'required',
                'description' => 'required',
            ]);

            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');

            $role->save();

            DB::table("permission_role")->where("permission_role.role_id", $id)->delete();
            // Attach permission to role
            foreach ($request->input('permission_id') as $key => $value) {
                $role->attachPermission($value);
            }

            return redirect()->route('roles.index')->with('success',
                "The role <strong>$role->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Delete Roles from DB
    public function destroy($id)
    {
        //
        try {
            $role = Role::findOrFail($id);

            //$role->delete();

            // Force Delete
            $role->users()->sync([]); // Delete relationship data
            $role->permissions()->sync([]); // Delete relationship data

            $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

            return redirect()->route('roles.index')->with('success',
                "The Role <strong>$role->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
