@extends('dashboard.layouts.app')

@section('content_title')
    Criar postagem
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Criarp ostagem</li>
@endsection

@section('main-content')
<?php
    var_dump(Route::current()->getAction());
?>
@endsection
@section('page-scripts')

@endsection