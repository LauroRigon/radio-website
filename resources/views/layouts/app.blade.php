<!DOCTYPE html>
<?php
    $categories = \App\Category::all();
    $supporters = \App\Supporter::where('status', 1)->get();
?>
<html>

@section('htmlheader')
    @include('layouts.partials.htmlheader')
    @yield('page-links')
@show

<body>
<div id="app" v-cloak>
    <div>
        @include('layouts.partials.mainheader')
                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper container">
            @include('layouts.partials.contentheader')

            <!-- Main content -->
            <section class="content" id="content">

                <!-- Your Page Content Here -->
                @yield('main-content')
                @include('layouts.partials.rightside')

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <music-order send-order-api="{{ route('order_store') }}"></music-order>
        @include('layouts.partials.footer')

    </div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('layouts.partials.scripts')
@show

</body>
<script>
    $(document).ready(function(){
        $('.dropdown-submenu a.drop-level').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>
<script>
    (function($) {
        "use strict"; // Start of use strict
        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 100
        });

        // Offset for Main Navigation
        $('#mainNav').affix({
            offset: {
                top: 50
            }
        })

    })(jQuery); // End of use strict

</script>
@yield('page-scripts')
</html>
