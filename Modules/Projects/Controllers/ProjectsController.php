<?php

namespace Modules\Projects\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Projects\Models\Project;
use Yajra\Datatables\Facades\Datatables;

class ProjectsController extends Controller
{
    /** @var  ProjectRepository */
    private $roleRepository;

    public function __construct()
    {
    }


    /**
     * Display a listing of the Project.
     *
     * @param ProjectDataTable $roleDataTable
     * @return Response
     */
    public function index()
    {
        return view('projects.projects_index');
    }


    public function anyData()
    {
        $projects = Project::select(['id', 'name', 'slug', 'due_date']);

        return Datatables::of($projects)
            ->addColumn('namelink', function ($projects) {
                return '<a href="#">' . $projects->name . '</a>';
            })
            ->addColumn('slug', function ($projects) {
                return '<a href="projects/' . $projects->id . '" ">' . $projects->slug . '</a>';
            })
            ->addColumn('due_date', function ($projects) {
                return '<a href="projects/' . $projects->id . '" ">' . $projects->due_date . '</a>';
            })
            ->addColumn('edit', '
                <a href="{{ route(\'projects.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->addColumn('delete', '
                <form action="{{ route(\'projects.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->rawColumns(['namelink', 'slug', 'due_date', 'edit', 'delete'])
            ->make(true);
    }


    // Projects Creation Page
    public function create()
    {
        //
        $permissions = Permission::all();

        $params = [
            'title' => 'Create Projects',
            'permissions' => $permissions,
        ];

        return view('projects.projects_create')->with($params);
    }

    // Projects Store to DB
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:projects',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $role = Project::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('projects.index')->with('success',
            "The role <strong>$role->name</strong> has successfully been created.");
    }

    // Projects Delete Confirmation Page
    public function show($id)
    {
        //
        try {
            $role = Project::findOrFail($id);

            $params = [
                'title' => 'Delete Project',
                'role' => $role,
            ];

            return view('admincp.projects.projects_delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Projects Editing Page
    public function edit($id)
    {
            $project = Project::findOrFail($id);
            $params = [
                'project' => $project,
            ];
        return view('projects.projects_edit')->with($params);
    }

    // Projects Update to DB
    public function update(Request $request, $id)
    {
        //
        try {
            $role = Project::findOrFail($id);

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

            return redirect()->route('projects.index')->with('success',
                "The role <strong>$role->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    // Delete Projects from DB
    public function destroy($id)
    {
        //
        try {
            $role = Project::findOrFail($id);

            //$role->delete();

            // Force Delete
            $role->users()->sync([]); // Delete relationship data
            $role->permissions()->sync([]); // Delete relationship data

            $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

            return redirect()->route('projects.index')->with('success',
                "The Project <strong>$role->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
