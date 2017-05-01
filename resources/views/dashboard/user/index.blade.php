@extends('dashboard.layouts.app')

@section('content_title')
Usuários
@endsection

@section('main-content')
    <vue-table title="Tabela de usuários"
				:has-actions="true"
				:fields="['Id', 'Nome', 'Email', 'Master', 'Ação']"
				:fillable="['id', 'name', 'email', 'is_master']"
				source-data="users/getUsers"></vue-table>

	<view-modal title="Detalhes do usuário"></view-modal>
	
@endsection
@section('page-scripts')
<script>

</script>
@endsection