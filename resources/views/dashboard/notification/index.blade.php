@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Notificações
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Notificações</li>
@endsection

@section('main-content')
    <notifications get-notifications-api="{{ route('notification_get') }}"></notifications>
@endsection
@section('page-scripts')