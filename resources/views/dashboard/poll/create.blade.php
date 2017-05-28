@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Criar votações
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Criar votações</li>
@endsection

@section('main-content')
    <div class="box box-primary">
        <div class="box-body">

            <poll-create></poll-create>

        </div>
    </div>


    </div>

@endsection
@section('page-scripts')

@endsection