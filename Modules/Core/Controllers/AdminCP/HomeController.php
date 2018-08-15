<?php

namespace Modules\Core\Controllers\AdminCP;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admincp.home');
    }


//Route::get('/', '\Modules\Core\Controllers\AdminCP\HomeController@admincp')->name('admincp');


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admincp()
    {
        $data = [
            //'n_users' => $n_users,
            //'n_roles' => $n_roles,
            //'n_perms' => $n_perms,
            'n_logged' => Auth::user()->name,

        ];
        return view('admincp.dashboard',$data);

    }


}
