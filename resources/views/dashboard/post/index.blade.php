@extends('dashboard.layouts.app')

@section('page-links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.css') }}">


@endsection

@section('content_title')
    Postagens
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Criar postagem</li>
@endsection

@section('main-content')
    <vue-table title="Tabela de posts"
               :has-actions="true"
               :fields="['Id', 'Titulo', 'Categoria', 'Visualizações', 'Publicado em', 'Ação']"
               :fillable="['id', 'title', 'category_id', 'published_at', 'view_count']"
               source-data="posts/getMyPosts"
               delete-api="users/delete/"
               :actions="['view', 'remove', 'create', 'edit']"
               ></vue-table>

    <redirector></redirector>

@endsection
@section('page-scripts')
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.js') }}"></script>


@endsection
