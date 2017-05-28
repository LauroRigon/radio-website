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
               :fields="[
                  {
                    name: 'Id',
                    dbName: 'id'
                  },
                  {
                    name: 'Nome',
                    dbName: 'name'
                  },
                  {
                    name: 'Descrição',
                    dbName: 'description'
                  },
                  {
                    name: 'Criado em',
                    dbName: 'created_at'
                  },
                  {
                    name: '__actions'
                  }
               ]"
               source-data="categories/getCategories"
               delete-api="categories/delete/"
               :tb-buttons="[
                    { name: 'create-button', class: 'btn btn-primary', emit: 'open-create-modal', text: 'Criar'},
                ]"
                :actions="[
                    { name: 'edit-item', icon: 'glyphicon glyphicon-pencil', class: 'btn btn-warning', emit: 'open-edit-modal'},
                    { name: 'delete-item', icon: 'glyphicon glyphicon-trash', class: 'btn btn-danger'}
                ]"></vue-table>

    <category-create-modal title="Criar categoria"></category-create-modal>
    <category-edit-modal title="Editar categoria"></category-edit-modal>

@endsection
@section('page-scripts')

@endsection