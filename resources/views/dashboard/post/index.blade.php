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
               :has-actions="true"
               :fields="['Id', 'Titulo', 'Categoria', 'Visualizações', 'Publicado em', 'Ação']"
               :fillable="['id', 'title', 'category_id', 'published_at', 'view_count']"
               source-data="posts/getMyPosts"
               delete-api="posts/delete/"
               :actions="['view', 'remove', 'create', 'edit']"
               ></vue-table>

    <redirector trigger="open-create-modal"
                @trigged="redirectToEdit"
                path="posts/edit/"></redirector>

@endsection
@section('page-scripts')
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dashboard/plugins/dropzone/dist/dropzone.js') }}"></script>
<script>
    
</script>
@endsection
