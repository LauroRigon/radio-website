<template>
	<div>
	<aside class="main-sidebar">

    <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="fdfd" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Content</a>
                </div>
            </div>


        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder=""/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Content</li>
            <!-- Optionally, you can add icons to the links -->
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
</div>
</template>

<script>
	export default {
		data: function() {
            return {
                user: {
                    shared: userData
                }
            }
        }
	}

</script>