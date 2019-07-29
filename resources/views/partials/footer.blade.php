<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        @if(config('admin.show_environment'))
            <strong>Env</strong>&nbsp;&nbsp; {!! env('APP_ENV') !!}
        @endif

        &nbsp;&nbsp;&nbsp;&nbsp;

        @if(config('admin.show_version'))
        <strong>Version</strong>&nbsp;&nbsp; {!! \Leave\Admin\Admin::VERSION !!}
        @endif

    </div>
    <!-- Default to the left -->
    <strong>Powered by <a href="https://github.com/z-song/leave-admin" target="_blank">leave-admin</a></strong>
</footer>