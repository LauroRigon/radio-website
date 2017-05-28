@extends('dashboard.layouts.app')

@section('page-links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.css') }}">


@endsection

@section('content_title')
    Minhas postagens
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Minhas postagens</li>
@endsection

@section('main-content')
    <vue-table title="Tabela de posts"
               :fields="[
                  {
                    name: 'Id',
                    dbName: 'id'
                  },
                  {
                    name: 'Título',
                    dbName: 'title'
                  },
                  {
                    name: 'Categoria',
                    dbName: 'category_id'
                  },
                  {
                    name: 'Visualizações',
                    dbName: 'view_count'
                  },
                  {
                    name: 'Publicado em',
                    dbName: 'published_at'
                  },
                  {
                    name: '__actions'
                  }
               ]"
               source-data="posts/getMyPosts"
               delete-api="posts/delete/"
               :tb-buttons="[
                    { name: 'create-button', class: 'btn btn-primary', href: 'create', text: 'Criar'},
                ]"
               :actions="[
                    { name: 'view-item', icon: 'glyphicon glyphicon-search', class: 'btn btn-info', href: 'preview/', param: 'true'},
                    { name: 'edit-item', icon: 'glyphicon glyphicon-pencil', class: 'btn btn-warning', href: 'edit/', param: 'true'},
                    { name: 'delete-item', icon: 'glyphicon glyphicon-trash', class: 'btn btn-danger'}
                ]"
               ></vue-table>
@endsection
@section('page-scripts')
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.js') }}"></script>
<script>
    
</script>
@endsection
