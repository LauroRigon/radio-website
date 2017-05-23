@extends('dashboard.layouts.app')

@section('page-links')
<style>
    .box{
        padding-left: 15%;
        padding-right: 15%;
    }
</style>

@endsection

@section('content_title')
    Pré-visualização de postagem
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Criar postagem</li>
@endsection

@section('main-content')
    @if (count(session('alert')) > 0)
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> Atenção!</h4>
            {{ session('alert') }}
        </div>
    @endif
    @if (count(session('success')) > 0)
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> Sucesso!</h4>
            {{ session('success') }}
        </div>
    @endif

    <div class="box box-primary">
        <div class="box-body">
            <div class="row text-center">
                <h1>{{ $post->title }}</h1>
            </div>
            <div class="row">
                <div class="text-center">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.js') }}"></script>

@endsection