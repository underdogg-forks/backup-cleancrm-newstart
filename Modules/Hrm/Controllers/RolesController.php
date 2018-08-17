<?php

namespace Modules\Hrm\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Permission;
use Yajra\Datatables\Facades\Datatables;
use Modules\Hrm\Models\Employee;
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



    public function anyData()
    {
        $employees = Employee::select(['id', 'first_name', 'last_name', 'idnr']);

        return Datatables::of($employees)
            ->addColumn('first_name', function ($employees) {
                return '<a href="#">' . $employees->first_name . '</a>';
            })
            ->addColumn('last_name', function ($employees) {
                return '<a href="roles/' . $employees->id . '" ">' . $employees->last_name . '</a>';
            })
            ->addColumn('idnr', function ($employees) {
                return '<a href="roles/' . $employees->id . '" ">' . $employees->idnr . '</a>';
            })
            ->addColumn('edit', '
                <a href="{{ route(\'roles.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->addColumn('delete', '
                <form action="{{ route(\'roles.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->rawColumns(['first_name', 'last_name', 'idnr', 'edit', 'delete'])
            ->orderColumns(['first_name', 'email'], '-:column $1')
            ->make(true);
    }


}
