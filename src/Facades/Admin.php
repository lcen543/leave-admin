<?php

namespace Leave\Admin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Admin.
 *
 * @method static \Leave\Admin\Grid grid($model, \Closure $callable)
 * @method static \Leave\Admin\Form form($model, \Closure $callable)
 * @method static \Leave\Admin\Show show($model, $callable = null)
 * @method static \Leave\Admin\Tree tree($model, \Closure $callable = null)
 * @method static \Leave\Admin\Layout\Content content(\Closure $callable = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void css($css = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void js($js = null)
 * @method static \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void script($script = '')
 * @method static \Illuminate\Contracts\Auth\Authenticatable|null user()
 * @method static string title()
 * @method static void navbar(\Closure $builder = null)
 * @method static void registerAuthRoutes()
 * @method static void extend($name, $class)
 * @method static void disablePjax()
 * @method static void booting(\Closure $builder)
 * @method static void booted(\Closure $builder)
 * @method static void bootstrap()
 *
 * @see \Leave\Admin\Admin
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Leave\Admin\Admin::class;
    }
}
