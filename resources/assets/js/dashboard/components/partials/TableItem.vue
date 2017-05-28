<template>
	<transition
    name="item-animate"
    enter-active-class="animated fadeIn"
    leave-active-class="animated bounceOutRight"
  	>
		<tr v-show="isVisible">
	      <td v-for="data in datas">{{data}}</td>
	      
			
	      <td v-if="hasAction()">
	        <div class="btn-group">
				<button class="btn btn-info" v-if="hasAction('view')" @click="viewAction(datas)"><i class="glyphicon glyphicon-search"></i></button>
	          	<button class="btn btn-warning" v-if="hasAction('edit')" @click="editAction(datas)"><i class="glyphicon glyphicon-pencil"></i></button>
	          	<button class="btn btn-danger" v-if="hasAction('remove')" @click="deleteAction(datas)"><i class="glyphicon glyphicon-trash"></i></button>
	        </div>
	      </td>
	    </tr>
    </transition>
</template>

<script>

	export default {
		props: {
			datas: {
				required: true
			},
			deleteApi: {
				type: String
			},

			actions: {
				type: Array
			}
		},
		data() {
			return {
				isVisible: true
			}
		},

		methods: {
			//se usada sem parametro, verifica se existe alguma action. Se usada com parametro deverá ser passado o nome da action a ser analisada então retorna true caso encontre a action no array de actions
			hasAction: function(action) {
				if(action == null){
					if(this.actions != null){
						return true;
					}else{
						return false;
					}
				}

				return this.actions.find(function(act) {
					return (act == action)? true: false;
				});
			},

			editAction: function(data) {
				Event.$emit("open-edit-modal", data);
			},

			deleteAction: function(data) {
				if(confirm("Tem certeza que deseja deletar esse item?") != 1) {
					return false;
				}

				axios.delete(this.deleteApi + data.id)
				.then(function(response) {
					this.isVisible = false
					toastr.success(response.data['status'])
				}.bind(this))

				.catch(function(error){
					if(error.response.status == 500){
						toastr.warning("Item tem dependências cadastradas!")
					}else{
						toastr.error(error.response.data['status'], "Ocorreu um erro ao deletar!")
					}
				});
				
			},

			viewAction: function(data) {
				Event.$emit("open-view-modal", data);
			}
		}


	}
</script>
