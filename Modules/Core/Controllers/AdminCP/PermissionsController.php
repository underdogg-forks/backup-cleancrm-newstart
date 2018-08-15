<?php

namespace Modules\Core\Controllers\AdminCP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\Models\User;
use Modules\Core\Models\Role;
use Modules\Core\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsController extends Controller
{
    // Permission Listing Page
    public function index()
    {
        //
        $permissions = Permission::paginate(10);
        dd($permissions);

        $params = [
            'title' => 'Permissions Listing',
            'permissions' => $permissions,
        ];

        return view('admincp.permissions.perm_list')->with($params);
    }

    // Permission Create Page
    public function create()
    {
        //
        $params = [
            'title' => 'Create Permission',
        ];

        return view('admincp.permissions.perm_create')->with($params);
    }

    // Permission Store to DB
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:permissions',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $permission = Permission::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('permissions.index')->with('success', "The Permission <strong>$permission->name</strong> has successfully been created.");
    }

    // Permission Delete Confirmation Page
    public function show($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);

            $params = [
                'title' => 'Delete Permission',
                'permission' => $permission,
            ];

            return view('admincp.permissions.perm_delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Permission Editing Page
    public function edit($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);

            $params = [
                'title' => 'Edit Permission',
                'permission' => $permission,
            ];

            //dd($role_permissions);

            return view('admincp.permissions.perm_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Permission update to DB
    public function update(Request $request, $id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);

            $this->validate($request, [
                'display_name' => 'required',
                'description' => 'required',
            ]);

            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');

            $permission->save();

            return redirect()->route('permissions.index')->with('success', "The permission <strong>$permission->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Permission Delete from DB
    public function destroy($id)
    {
        //
        try {
            $permission = Permission::findOrFail($id);
            DB::table("permission_role")->where('permission_id', $id)->delete();
            $permission->delete();
            
            return redirect()->route('permissions.index')->with('success', "The Role <strong>$permission->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
