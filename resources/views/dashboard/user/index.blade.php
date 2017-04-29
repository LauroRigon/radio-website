@extends('dashboard.layouts.app')

@section('content_title')
Usuários
@endsection

@section('main-content')
    <user-table title="Tabela de usuários"></user-table>
	
@endsection
@section('page-scripts')
<script>
	/*var tableConfig = new Vue({
		data: {
				users: {},
				heads: ['Id', 'Nome', 'Email', 'Master', 'Ação']
		},

		created() {
			axios.get('users/getUsers')
			.then(function(serverResponse) {
				this.users = serverResponse.data[0];				
				this.filterUsersData();
				this.tellTable();
			}.bind(this));
		},

		methods: {
			tellTable: function() {
				console.log(this.users);
				Event.$emit("dataToTable", this.users);
				Event.$emit("headsToTable", this.heads);
			},

			filterUsersData: function() {
				for(var i = 0; i < this.users.length; i++){
					delete this.users[i].avatar;
					delete this.users[i].updated_at;
					delete this.users[i].created_at;
				}
			}
		}
	})*/
</script>
@endsection