@extends('dashboard.layouts.app')

@section('content_title')
Usuários
@endsection

@section('content_header')
	<li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Usuários</li>
@endsection

@section('main-content')
    <vue-table title="Tabela de usuários"
				:has-actions="true"
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
                    name: 'Email',
                    dbName: 'email'
                  },
                  {
                    name: 'Master',
                    dbName: 'is_master'
                  },
                  {
                    name: '__actions'
                  }
               ]"
				source-data="users/getUsers"
				delete-api="users/delete/"
        :tb-buttons="[
                    { name: 'create-button', class: 'btn btn-primary', emit: 'open-create-modal', text: 'Criar'},
                ]"
				:actions="[
                    { name: 'view-item', icon: 'glyphicon glyphicon-search', class: 'btn btn-info', emit: 'open-view-modal'},
                    { name: 'delete-item', icon: 'glyphicon glyphicon-trash', class: 'btn btn-danger'}
                ]"></vue-table>

	<user-view-modal title="Detalhes do usuário"></user-view-modal>
	<user-create-modal title="Cadastrar novo usuário"></user-create-modal>
@endsection
@section('page-scripts')

@endsection