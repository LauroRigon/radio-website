
<aside class="main-sidebar">

    <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>

                    <small><i class="fa fa-circle text-success"></i> Online</small>
                </div>
            </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
			@if(Auth::user()->is_master == 1)
				<li><a href="{{route('user_index')}}"><i class='fa fa-user-circle-o'></i> <span>Usuários</span></a></li>
			@endif
            <li class="active"><a href=""><i class='fa fa-link'></i> <span>Content</span></a></li>
            <li><a href="#"><i class='fa fa-link'></i> <span>Content</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Content</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Content</a></li>
                    <li><a href="#">Content</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>