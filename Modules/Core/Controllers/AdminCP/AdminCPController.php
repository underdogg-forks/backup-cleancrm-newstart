<?php

namespace Modules\Core\Controllers\AdminCP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\Models\User;
use Modules\Core\Models\Role;
use Modules\Core\Models\Permission;
use Illuminate\Support\Facades\Auth;


class AdminCPController extends Controller
{
    // Only Authenticated User have access to Dashboard
    public function __construct()
    {
        //$this->middleware('auth');
    }

    // Show Dashboard Page
    public function index()
    {
        $data = [];
        //$n_users = User::all()->count();
        //$n_roles = Role::all()->count();
        //$n_perms = Permission::all()->count();

$user = Auth::user()->name;
        dd($user);
        //$n_logged = Auth::user()->name;
        $data = [
            //'n_users' => $n_users,
            //'n_roles' => $n_roles,
            //'n_perms' => $n_perms,
            'n_logged' => $n_logged,

        ];
        return view('admincp.dashboard',$data);
    }

}
