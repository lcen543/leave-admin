<?php

namespace Leave\Admin\Traits;

trait HasAssets
{
    /**
     * @var array
     */
    public static $script = [];

    /**
     * @var array
     */
    public static $css = [];

    /**
     * @var array
     */
    public static $js = [];

    /**
     * @var array
     */
    public static $headerJs = [];

    /**
     * @var string
     */
    public static $manifest = 'vendor/leave-admin/minify-manifest.json';

    /**
     * @var array
     */
    public static $manifestData = [];

    /**
     * @var array
     */
    public static $min = [
        'js'  => 'vendor/leave-admin/leave-admin.min.js',
        'css' => 'vendor/leave-admin/leave-admin.min.css',
    ];

    /**
     * @var array
     */
    public static $baseCss = [
        'vendor/leave-admin/AdminLTE/bootstrap/css/bootstrap.min.css',
        'vendor/leave-admin/font-awesome/css/font-awesome.min.css',
        'vendor/leave-admin/leave-admin/leave-admin.css',
        'vendor/leave-admin/nprogress/nprogress.css',
        'vendor/leave-admin/sweetalert2/dist/sweetalert2.css',
        'vendor/leave-admin/nestable/nestable.css',
        'vendor/leave-admin/toastr/build/toastr.min.css',
        'vendor/leave-admin/bootstrap3-editable/css/bootstrap-editable.css',
        'vendor/leave-admin/google-fonts/fonts.css',
        'vendor/leave-admin/AdminLTE/dist/css/AdminLTE.min.css',
    ];

    /**
     * @var array
     */
    public static $baseJs = [
        'vendor/leave-admin/AdminLTE/bootstrap/js/bootstrap.min.js',
        'vendor/leave-admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js',
        'vendor/leave-admin/AdminLTE/dist/js/app.min.js',
        'vendor/leave-admin/jquery-pjax/jquery.pjax.js',
        'vendor/leave-admin/nprogress/nprogress.js',
        'vendor/leave-admin/nestable/jquery.nestable.js',
        'vendor/leave-admin/toastr/build/toastr.min.js',
        'vendor/leave-admin/bootstrap3-editable/js/bootstrap-editable.min.js',
        'vendor/leave-admin/sweetalert2/dist/sweetalert2.min.js',
        'vendor/leave-admin/leave-admin/leave-admin.js',
    ];

    /**
     * @var string
     */
    public static $jQuery = 'vendor/leave-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js';

    /**
     * Add css or get all css.
     *
     * @param null $css
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function css($css = null)
    {
        if (!is_null($css)) {
            return self::$css = array_merge(self::$css, (array) $css);
        }

        if (!$css = static::getMinifiedCss()) {
            $css = array_merge(static::$css, static::baseCss());
        }

        $css = array_filter(array_unique($css));

        return view('admin::partials.css', compact('css'));
    }

    /**
     * @param null $css
     *
     * @return array|null
     */
    public static function baseCss($css = null)
    {
        if (!is_null($css)) {
            return static::$baseCss = $css;
        }

        $skin = config('admin.skin', 'skin-blue-light');

        array_unshift(static::$baseCss, "vendor/leave-admin/AdminLTE/dist/css/skins/{$skin}.min.css");

        return static::$baseCss;
    }

    /**
     * Add js or get all js.
     *
     * @param null $js
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function js($js = null)
    {
        if (!is_null($js)) {
            return self::$js = array_merge(self::$js, (array) $js);
        }

        if (!$js = static::getMinifiedJs()) {
            $js = array_merge(static::baseJs(), static::$js);
        }

        $js = array_filter(array_unique($js));

        return view('admin::partials.js', compact('js'));
    }

    /**
     * Add js or get all js.
     *
     * @param null $js
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function headerJs($js = null)
    {
        if (!is_null($js)) {
            return self::$headerJs = array_merge(self::$headerJs, (array) $js);
        }

        return view('admin::partials.js', ['js' => array_unique(static::$headerJs)]);
    }

    /**
     * @param null $js
     *
     * @return array|null
     */
    public static function baseJs($js = null)
    {
        if (!is_null($js)) {
            return static::$baseJs = $js;
        }

        return static::$baseJs;
    }

    /**
     * @param string $script
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function script($script = '')
    {
        if (!empty($script)) {
            return self::$script = array_merge(self::$script, (array) $script);
        }

        return view('admin::partials.script', ['script' => array_unique(self::$script)]);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    protected static function getManifestData($key)
    {
        if (!empty(static::$manifestData)) {
            return static::$manifestData[$key];
        }

        static::$manifestData = json_decode(
            file_get_contents(public_path(static::$manifest)), true
        );

        return static::$manifestData[$key];
    }

    /**
     * @return bool|mixed
     */
    protected static function getMinifiedCss()
    {
        if (!config('admin.minify_assets') || !file_exists(public_path(static::$manifest))) {
            return false;
        }

        return static::getManifestData('css');
    }

    /**
     * @return bool|mixed
     */
    protected static function getMinifiedJs()
    {
        if (!config('admin.minify_assets') || !file_exists(public_path(static::$manifest))) {
            return false;
        }

        return static::getManifestData('js');
    }

    /**
     * @return string
     */
    public function jQuery()
    {
        return admin_asset(static::$jQuery);
    }
}
