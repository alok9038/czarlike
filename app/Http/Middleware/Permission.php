<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,string $permission)
    {
        if($permission == 'manage_product' && Auth::user()->user_type == 'admin'){
            if(check_permission('product_manage') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'manage_product'){
            if(check_permission('product_manage') != 1){
                abort(403);
            }
        }
        if($permission == 'categories' && Auth::user()->user_type == 'admin'){
            if(check_permission('categories_manage') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'categories'){
            if(check_permission('categories_manage') != 1){
                abort(403);
            }
        }
        if($permission == 'category' && Auth::user()->user_type == 'admin'){
            if(check_permission('category') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'category'){
            if(check_permission('category') != 1){
                abort(403);
            }
        }
        if($permission == 'subcategory' && Auth::user()->user_type == 'admin'){
            if(check_permission('sub_category') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'subcategory'){
            if(check_permission('sub_category') != 1){
                abort(403);
            }
        }
        if($permission == 'childcategory' && Auth::user()->user_type == 'admin'){
            if(check_permission('child_category') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'childcategory'){
            if(check_permission('child_category') != 1){
                abort(403);
            }
        }
        if($permission == 'brand' && Auth::user()->user_type == 'admin'){
            if(check_permission('brand') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'brand'){
            if(check_permission('brand') != 1){
                abort(403);
            }
        }
        if($permission == 'location' && Auth::user()->user_type == 'admin'){
            if(check_permission('locations') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'location'){
            if(check_permission('locations') != 1){
                abort(403);
            }
        }
        if($permission == 'slider' && Auth::user()->user_type == 'admin'){
            if(check_permission('slider') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'slider'){
            if(check_permission('slider') != 1){
                abort(403);
            }
        }
        if($permission == 'store' && Auth::user()->user_type == 'admin'){
            if(check_permission('create_store') != 1){
                abort(403);
            }
        }
        if(Auth::user()->user_type == 'seller' && $permission == 'store'){
            if(check_permission('create_store') != 1){
                abort(403);
            }
        }
        return $next($request);
    }
}
