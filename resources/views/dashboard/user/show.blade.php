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
		<user-profile user-api="{{route('getCurrentUser')}}"></user-profile>
</div>

@endsection
@section('page-scripts')

@endsection