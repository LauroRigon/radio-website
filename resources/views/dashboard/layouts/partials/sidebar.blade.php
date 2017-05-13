
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
				<li class="{{ Route::currentRouteName() == 'user_index'? 'active' : ''}}"><a href="{{route('user_index')}}"><i class="fa fa-user-circle-o"></i> <span>Usuários</span></a></li>
			@endif
            <li class="treeview {{ Route::currentRouteName() == 'categories'? 'active' : ''}}">
                <a href="#"><i class='fa fa-files-o'></i> <span>Postagens</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Route::currentRouteName() == 'categories'? 'active' : ''}}"><a href="{{route('categories')}}">Categorias</a></li>
                    <li class="{{ Route::currentRouteName() == 'post_create'? 'active' : ''}}"><a href="{{route('post_create')}}">Criar postagem</a></li>
                    <li><a href="#">Content</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>