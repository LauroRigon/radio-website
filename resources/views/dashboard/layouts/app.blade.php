<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

@section('htmlheader')
    @include('dashboard.layouts.partials.htmlheader')

    @yield('page-links')
@show

<body class="skin-blue sidebar-mini">
<div id="app" v-cloak>
    <div class="wrapper">

    @include('dashboard.layouts.partials.mainheader')

    @include('dashboard.layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('dashboard.layouts.partials.contentheader')

        <!-- Main content -->
        <section class="content" id="content">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('dashboard.layouts.partials.footer')

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('dashboard.layouts.partials.scripts')
@show

</body>
@yield('page-scripts')
</html>
