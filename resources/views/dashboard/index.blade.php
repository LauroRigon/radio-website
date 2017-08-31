@extends('dashboard.layouts.app')

@section('content_title')
Dashboard
@endsection

@section('content_header')
	<li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@endsection

@section('main-content')
    
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-newspaper-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Postagens</span>
          <span class="info-box-number">{{ $posts }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-eye"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Visualizações</span>
          <span class="info-box-number">{{ $postsViews }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

</div>
@if(isset($lastPoll) && isset($lastPollOptions))
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Última enquete sua ativa</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <strong><p class="text-center">{{ $lastPoll['title'] }}</p></strong>
                    @foreach($lastPollOptions as $option)
                        <div class="progress-group">
                            <span class="progress-text">{{ $option['name'] }}</span>
                            <span class="progress-number">{{ $option['vote_count'] }}</span>
                            <div class="progress sm">
                                <div class="progress-bar progress-bar-aqua" style="width: {{ ($option['vote_count'] != 0)? ($option['vote_count'] / $lastPoll['votesSum'])*100: ''}}%"></div>
                            </div>
                        </div>
                    @endforeach
                    <span class="description-text">Total</span>
                    <span class="progress-number pull-right">{{ $lastPoll['votesSum'] }}</span>
                    <div class="box-footer text-center">
                        <a href="{{ route('poll_view', $lastPoll['id']) }}">Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($generalData)
    <h3 class="page-header">Geral</h3>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-newspaper-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Postagens</span>
                    <span class="info-box-number">{{ $generalData['totalPosts'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-eye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Visualizações</span>
                    <span class="info-box-number">{{ $generalData['totalViews'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Usuários cadastrados</span>
                    <span class="info-box-number">{{ $generalData['totalUsers'] }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Postagens pendentes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Categoria</th>
                                <th>Criador</th>
                                <th>Ultima atualização</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($generalData['pendingPosts'] as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category }}</td>
                            <td>{{ $post->user()->get()[0]->name }}</td>
                            <td>{{ $post->updated_at }}</td>
                        </tr>
                        @endforeach
                        </tbody></table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix text-center">
                    <a href="{{ route('post_pending') }}">Ver todos</a>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
@section('page-scripts')

@endsection