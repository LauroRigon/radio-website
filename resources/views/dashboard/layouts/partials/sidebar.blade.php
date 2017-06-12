
<aside class="main-sidebar">

    <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <small><i class="fa fa-circle text-success"></i> Online</small>
                </div>
            </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li class="{{ Route::currentRouteName() == 'dashboard'? 'active' : ''}}"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			@if(Auth::user()->is_master == 'Sim')
				<li class="{{ Route::currentRouteName() == 'user_index'? 'active' : ''}}"><a href="{{route('user_index')}}"><i class="fa fa-users"></i> <span>Usuários</span></a></li>
			@endif
            <li class="treeview {{ Route::current()->getAction()['prefix'] == 'admin/posts'? 'active' : ''}}">
                <a href="#"><i class='fa fa-newspaper-o'></i> <span>Postagens</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Route::currentRouteName() == 'post_index'? 'active' : ''}}"><a href="{{route('post_index')}}">Minhas postagens</a></li>
                    <li class="{{ Route::currentRouteName() == 'post_create'? 'active' : ''}}"><a href="{{route('post_create')}}">Criar postagem</a></li>
                    @if(Auth::user()->is_master == 'Sim')
                        <li class="{{ Route::currentRouteName() == 'post_pending'? 'active' : ''}}"><a href="{{route('post_pending')}}">Postagens pendentes</a></li>
                    @endif

                </ul>
            </li>
            <li class="{{ Route::currentRouteName() == 'categories'? 'active' : ''}}"><a href="{{route('categories')}}"><i class="fa fa-list"></i><span>Categorias</span></a></li>
            <li class="treeview {{ Route::current()->getAction()['prefix'] == 'admin/polls'? 'active' : ''}}">
                <a href="#"><i class='fa fa-tags'></i> <span>Enquetes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Route::currentRouteName() == 'poll_create'? 'active' : ''}}"><a href="{{route('poll_create')}}">Criar enquete</a></li>
                    <li class="{{ Route::currentRouteName() == 'poll_index'? 'active' : ''}}"><a href="{{route('poll_index')}}">Minhas enquetes</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>