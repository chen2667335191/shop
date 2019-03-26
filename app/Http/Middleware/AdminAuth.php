<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\View\View;
use App\Rbac\Permission;
class AdminAuth
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
        $session = $request->session();
        if (!$session->has('user')){//如果用户未登录，跳转到登陆页面

            return redirect('/admin/login')->send();
        }
        //完成视图的共享
        \Illuminate\Support\Facades\View::share('username',$session->get('user.username'));
        \Illuminate\Support\Facades\View::share('user_pic',$session->get('user.image_url'));
        //左侧菜单视图共享
        $user = $session->get('user');
        //dd($user);
        \Illuminate\Support\Facades\View::share('menus', Permission::getMenus($user));

        return $next($request);
    }
}
