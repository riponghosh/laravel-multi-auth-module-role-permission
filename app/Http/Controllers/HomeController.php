<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Module_access;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roles=Role::all();
        return view('home',compact('roles'));
    }

    public function role($id)
    {
        $roles=Role::all();
        $module_access=Module_access::where('role_id',$id)->pluck('module_access')->all();
        // return implode(",",$module_access);
        // $value = strstr(implode(",",$module_access), "api"); 

        $module_access_string=implode(",",$module_access).',';
        $value = strstr(strstr($module_access_string, '/passengers'), ",", true);
        preg_match("<".'api'."-(.*?),>", $module_access_string, $goto_url);
        // return $goto_url;

        return view('home',compact('roles','module_access_string'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $allAccess=[];
        Module_access::where('role_id', $request->role_id)->delete();
        foreach ($request->all() as $key => $value) {
            if (is_array($value)) {
                $access= $key."-".implode("-",$value);
                $allAccess[]=
                    [
                        'role_id' => $request->role_id,
                        'module_access' => $access
                    ];
            }
        }

        Module_access::insert($allAccess);
        return back();
    }
}
