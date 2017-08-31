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

        <!-- MOSTRA OS FLASHS DE SESSÃO -->
        <div class="row">
        <div class="col-md-6">
        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>

                    @endforeach
                </ul>
            </div>
        @endif

        @if (count(session('success')) > 0)
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    {{ session('success') }}
                </ul>
            </div>
        @endif

        @if (count(session('alert')) > 0)
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    {{ session('alert') }}
                </ul>
            </div>
        @endif

        @if (count(session('warning')) > 0)
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    {{ session('warning') }}
                </ul>
            </div>
        @endif
        </div>
        </div>
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
