@extends('dashboard.layouts.app')

@section('content_title')
    Todas postagens
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Todas postagens</li>
@endsection

@section('main-content')
    <vue-table title="Tabela de posts"
               :fields="[
                  {
                    name: 'Título',
                    dbName: 'title'
                  },
                  {
                    name: 'Criador',
                    dbName: 'user_name'
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
               source-data="getAllPosts"
               delete-api="delete/"
               :tb-buttons="[
                    { name: 'create-button', class: 'btn btn-primary', href: 'admin/posts/create', text: 'Criar'},
                ]"
               :actions="[
                    { name: 'view-item', icon: 'glyphicon glyphicon-search', class: 'btn btn-info btn-sm', href: 'admin/posts/preview/', param: 'true'},
                    { name: 'edit-item', icon: 'glyphicon glyphicon-pencil', class: 'btn btn-warning btn-sm', href: 'admin/posts/edit/', param: 'true'},
                    { name: 'delete-item', icon: 'glyphicon glyphicon-trash', class: 'btn btn-danger btn-sm'}
                ]"
    ></vue-table>
@endsection
@section('page-scripts')
    <script type="text/javascript" src="{{ asset('js/dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.js') }}"></script>
    <script>

    </script>
@endsection
