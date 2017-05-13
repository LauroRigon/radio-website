@extends('dashboard.layouts.app')

@section('content_title')
    Usuários
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Categorias</li>
@endsection

@section('main-content')
    <vue-table title="Tabela de categorias"
               :has-actions="true"
               :fields="['Id', 'Nome', 'Descrição', 'Criado em', 'Ação']"
               :fillable="['id', 'name', 'description', 'created_date']"
               source-data="categories/getCategories"
               delete-api="categories/delete/"
               :actions="['edit', 'remove', 'create']"></vue-table>

    <category-create-modal title="Criar categoria"></category-create-modal>
    <category-edit-modal title="Editar categoria"></category-edit-modal>

@endsection
@section('page-scripts')

@endsection