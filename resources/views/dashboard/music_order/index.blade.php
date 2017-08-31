@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Pedidos de músicas
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Pedidos de músicas</li>
@endsection

@section('main-content')
    <music-orders get-music-order-api="{{ route('musicorder_get') }}"></music-orders>
@endsection
@section('page-scripts')