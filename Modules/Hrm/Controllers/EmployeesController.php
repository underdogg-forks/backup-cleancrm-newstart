<?php

namespace Modules\Hrm\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\Models\User;
use Modules\Hrm\Models\Employee;
use Modules\Core\Models\Role;
use Yajra\Datatables\Facades\Datatables;
use Modules\Core\Models\Permission;

class EmployeesController extends Controller
{
    //

    public function __construct()
    {
    }

    // Index Page for Employees
    public function index()
    {
        return view('hrm.employees.employees_index');
    }


    public function anyData()
    {
        $permissions = Permission::select(['id', 'name', 'display_name', 'description']);

        return Datatables::of($permissions)
            ->addColumn('id', function ($permissions) {
                return '<a href="permissions/' . $permissions->id . '" ">' . $permissions->display_name . '</a>';
            })
            ->make(true);
    }





    public function oldData()
    {
        //, 'first_name', 'last_name', 'bsn', 'idnr'])->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC')

        $employees = Employee::select(['id', 'first_name']);

        return Datatables::of($employees)
            ->addColumn('first_name', function ($employees) {
                return '<a href="#">' . $employees->first_name . '</a>';
            })
            ->addColumn('last_name', function ($employees) {
                return '<a href="employee/' . $employees->id . '" ">' . $employees->last_name . '</a>';
            })
            ->addColumn('bsn', function ($employees) {
                return '<a href="employee/' . $employees->id . '" ">' . $employees->bsn . '</a>';
            })
            ->addColumn('idnr', function ($employees) {
                return '<a href="employee/' . $employees->id . '" ">' . $employees->idnr . '</a>';
            })
            ->addColumn('edit', '
                <a href="{{ route(\'employees.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->addColumn('delete', '
                <form action="{{ route(\'employees.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->rawColumns(['first_name', 'email', 'edit', 'delete'])
            //->orderColumn('last_name', '-name $1')
            ->orderColumns(['first_name', 'email'], '-:column $1')

            ->make(true);
    }




    // Create Employee Page
    public function create()
    {
        $roles = Role::all();

        $params = [
            'title' => 'Create Employee',
            'roles' => $roles,
        ];

        return view('admincp.employee.employee_create')->with($params);
    }

    // Store New Employee
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:employee',
            'password' => 'required',
        ]);

        $employee = Employee::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $role = Role::find($request->input('role_id'));

        $employee->attachRole($role);

        return redirect()->route('employee.index')->with('success', "The Employee <strong>$employee->name</strong> has successfully been created.");
    }

    // Delete Confirmation Page
    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $params = [
                'title' => 'Confirm Delete Record',
                'Employee' => $employee,
            ];

            return view('admincp.employee.employee_delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Editing Employee Information Page
    public function edit($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            //$employee = Role::all();
            $employee = Role::with('permissions')->get();
            $permissions = Permission::all();

            $params = [
                'title' => 'Edit Employee',
                'Employee' => $employee,
                'employee' => $employee,
                'permissions' => $permissions,
            ];

            return view('admincp.employee.employee_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Update Employee Information to DB
    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:employee,email,' . $id,
            ]);

            $employee->name = $request->input('name');
            $employee->email = $request->input('email');

            $employee->save();

            // Update role of the Employee
            $employees = $employee->Employees;

            foreach ($employees as $key => $value) {
                $employee->detachRole($value);
            }

            $role = Role::find($request->input('role_id'));

            $employee->attachRole($role);

            // Update permission of the Employee
            //$permission = Permission::find($request->input('permission_id'));
            //$employee->attachPermission($permission);

            return redirect()->route('Employees.index')->with('success', "The Employee <strong>$employee->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Remove Employee from DB with detaching Role
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            // Detach from Role
            $employees = $employee->Employees;

            foreach ($employees as $key => $value) {
                $employee->detachRole($value);
            }

            $employee->delete();

            return redirect()->route('Employees.index')->with('success', "The Employee <strong>$employee->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
