<?php

namespace App\Http\Middleware;

use Closure;
use App\Module_access;
use Auth;
use Session;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::get('module_access')) {
            $module_access=Module_access::where('role_id',Auth::user()->role_id)->pluck('module_access')->all();
            $module_access_string=implode(",",$module_access).',';
            Session::put('module_access', $module_access_string);
        }
        $current_request_access=explode('-',$request->route()->action['as']);
        preg_match("<".$request->route()->getPrefix()."-(.*?),>", Session::get('module_access'), $access);
        if ($current_request_access&&isset($current_request_access[1])&&($current_request_access[1]=='read'||$current_request_access[1]=='create'||$current_request_access[1]=='edit'||$current_request_access[1]=='update'||$current_request_access[1]=='delete')) {
            if(strpos($access[1],$current_request_access[1])===false){
                return back()->with('status','You are no permission to '.$current_request_access[1].' '.preg_replace("/\//", " ",$request->route()->getPrefix()));
            }
        }
        
        
        return $next($request);
    }
}
