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
                    name: 'Título',
                    dbName: 'title'
                  },
                  {
                    name: 'Categoria',
                    dbName: 'category_id'
                  },
                  {
                    name: 'Criador',
                    dbName: 'user_name'
                  },
                  {
                    name: 'Criado em',
                    dbName: 'created_at'
                  },
                  {
                    name: 'Ultima atualização',
                    dbName: 'updated_at'
                  },
                  {
                    name: '__actions'
                  }
               ]"
               source-data="/admin/posts/getPendingPosts"
               :actions="[
                    { name: 'view-item', icon: 'glyphicon glyphicon-search', class: 'btn btn-info', href: 'admin/posts/preview/', param: 'true'}
                ]"
               ></vue-table>

@endsection
@section('page-scripts')
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.js') }}"></script>
<script>
    
</script>
@endsection
