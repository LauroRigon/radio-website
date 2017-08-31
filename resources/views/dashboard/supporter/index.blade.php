@extends('dashboard.layouts.app')

@section('page-links')

@endsection

@section('content_title')
    Apoiadores
@endsection

@section('content_header')
    <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Apoiadores</li>
@endsection

@section('main-content')
    <vue-table title="Tabela de apoiadores"
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
                    name: 'Imagem',
                    dbName: 'image'
                  },
                  {
                    name: 'Situação',
                    dbName: 'status'
                  },
                  {
                    name: '__actions'
                  }
               ]"
               source-data="supporters/getSupporters"
               delete-api="supporters/delete/"
               :tb-buttons="[
                    { name: 'create-button', class: 'btn btn-primary', href: 'admin/supporters/create', text: 'Criar'},
                ]"
               :actions="[
                    { name: 'edit-item', icon: 'glyphicon glyphicon-pencil', class: 'btn btn-warning', href: 'admin/supporters/edit/', param: 'true'},
                    { name: 'delete-item', icon: 'glyphicon glyphicon-trash', class: 'btn btn-danger'}
                ]"
    ></vue-table>
@endsection
@section('page-scripts')

@endsection