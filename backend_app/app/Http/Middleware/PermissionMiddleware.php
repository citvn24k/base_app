<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $route = $request->route()->getAction();
        if (array_key_exists('controller', $route)) {
            $action = explode('@', $route['controller']);
            $path = $action[0];
            $key = str_replace('Controller', '', last(explode('\\', $path)));
            if ($key) {
                if (app('auth')->guest()) {
                    throw UnauthorizedException::notLoggedIn();
                }
                if ($permission == 'resource') {
                    $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];
                    $act = $action[1];
                    if (in_array($act, $resourceDefaults)) {
                        switch ($act) {
                            case 'index':
                            case 'show':
                                if (app('auth')->user()->can($key . '_view')) {
                                    return $next($request);
                                }
                                break;
                            case 'store':
                            case 'create':
                                if (app('auth')->user()->can($key . '_create')) {
                                    return $next($request);
                                }
                                break;
                            case 'edit':
                            case 'update':
                                if (app('auth')->user()->can($key . '_edit')) {
                                    return $next($request);
                                }
                                break;
                            case 'destroy':
                                if (app('auth')->user()->can($key . '_delete')) {
                                    return $next($request);
                                }
                                break;
                            default:
                                return false;
                        }
                    }
                }
                $permissions = is_array($permission)
                    ? $permission
                    : explode('|', $permission);
                foreach ($permissions as $permission) {
                    if (app('auth')->user()->can($key . '_' . $permission)) {
                        return $next($request);
                    }
                }

                throw UnauthorizedException::forPermissions($permissions);
            }
        }

        return $next($request);
    }
}
