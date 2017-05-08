@extends('dashboard.layouts.app')

@section('content_title')
    Perfil
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Perfil</li>
@endsection

@section('main-content')
<div class="col-md-8">
	<tabs>
		<tab name="Perfil" :selected="true">
			<div id="profile">
	          <div class="box box-widget widget-user">
	            <!-- Add the bg color to the header using any of the bg-* classes -->
	            <div class="widget-user-header bg-aqua-active">
	              <h3 class="widget-user-username">{{$user->name}}</h3>
	              @if($user->is_master)
	                <span class="label label-danger">Master</span>
	              @endif
	            </div>
	            <div class="widget-user-image">                
	                <img class="img-circle" alt="User Avatar" src="{{$user->avatar}}">
	            </div>
	            <div class="box-footer">
	              <div class="row">
	                <div class="col-sm-4 border">
	                  <div class="description-block">
	                    <h5 class="description-header">{{$user->id}}</h5>
	                    <span class="description-text">Id</span>
	                  </div>
	                  <!-- /.description-block -->
	                </div>
	                <!-- /.col -->
	                <div class="col-sm-4 border">
	                  <div class="description-block">
	                    <h5 class="description-header">{{$user->email}}</h5>
	                    <span class="description-text">Email</span>
	                  </div>
	                  <!-- /.description-block -->
	                </div>
	                <!-- /.col -->
	                <div class="col-sm-4">
	                  <div class="description-block">
	                    <h5 class="description-header">{{$user->created_date}}</h5>
	                    <span class="description-text">Data do cadastrado</span>
	                  </div>
	                  <!-- /.description-block -->
	                </div>
	                <!-- /.col -->
	              </div>
	              <!-- /.row -->
	            </div>
	          </div>
	      	</div>
		</tab>
		<tab name="Alterar avatar">
			<avatar-upload token="{{csrf_token()}}">
				<template slot="token">
					{{ csrf_field() }}
				</template>
			</avatar-upload>
		</tab>
		<tab name="Senha">
			Comigo
		</tab>
	</tabs>
</div>

@endsection
@section('page-scripts')

@endsection