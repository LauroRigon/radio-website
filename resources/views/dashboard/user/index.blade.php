@extends('dashboard.layouts.app')

@section('content_title')
Usuários
@endsection

@section('main-content')
    <vue-table title="Tabela de usuários"
				:has-actions="true"
				:fields="['Id', 'Nome', 'Email', 'Master', 'Ação']"
				:fillable="['id', 'name', 'email', 'is_master']"
				source-data="users/getUsers"
				delete-api="users/delete/"
				:actions="['view', 'remove', 'create']"></vue-table>

	<user-view-modal title="Detalhes do usuário"></user-view-modal>
	<user-create-modal title="Cadastrar novo usuário"></user-create-modal>
	
@endsection
@section('page-scripts')

@endsection