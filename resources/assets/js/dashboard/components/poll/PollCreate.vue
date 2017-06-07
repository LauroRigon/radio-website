<template>
<div>
	<form @submit.prevent='' @keydown="clearError($event.target.name)">
		<div class="form-group col-md-6">
			<div class="row">
				<div class="form-group col-md-8" :class="{'has-error': getError('title')}">
					<label for='title'>Título</label>
					<input type="text" class="form-control has-error" id='title' name="title" placeholder="Digite o título da enquete aqui" 
					v-model="poll.title">
					<span class="help-block" v-text="getError('title')" v-if="getError('title')"></span>
				</div>

			</div>

		<label>Opções da enquete</label>
			<ol>
				<li v-for="(option, index) in poll.options" class="li-item">{{option}} <button type="button" class="close" @click="deleteItem(index)">×</button></li>
			</ol>
			<div class="input-group" :class="{'has-error': getError('options')}">
				<input  type="text" class="form-control" name="options" placeholder="Digite uma opção para a enquete aqui" v-model="optionField" @keyup.enter="addOption">
				<span class="input-group-btn">
                  <button type="button" class="btn btn-info" @click="addOption">Adicionar!</button>
                </span>
            </div>
			<div style="margin-top: 2%">
				<button type="button" class="btn btn-primary" @click="sendForm" :disabled="isLoading"><i class="fa fa-refresh fa-spin" 
				v-show="isLoading"></i> Concluir</button>

				<button type="button" class="btn btn-warning pull-right" @click="clearFields">Limpar campos</button>
			</div>
		</div>
	</form>
</div>
</template>

<script>
	export default {
		data(){
			return {
				optionField: '',
				poll: {
					title: '',
					options: []
				},
				isLoading: false,
				errors: []
			}
		},

		methods: {
			addOption: function() {
				if(this.optionField){
					this.poll.options.push(this.optionField);
					this.optionField = '';
				}
			},

			sendForm: function() {
				this.isLoading = true;

				axios.post('store', this.poll)
				.then(function(response){
					toastr.success('Votação cadastrada com sucesso!');
					this.clearFields();
					this.isLoading = false;
				}.bind(this))

				.catch(function(error){
					this.errors = error.response.data[0];
					
					this.isLoading = false;
				}.bind(this))
			},

			clearFields: function() {
				this.poll.title = '';
				this.poll.options = [];
			},

			deleteItem: function(item) {
				this.poll.options.shift(item);
			},

			getError: function(error) {
		      if(this.errors[error]){
		        return this.errors[error][0]
		      }else{
		        return false
		      }
		    },

		    clearError: function(error) {
		      delete this.errors[error]
		    }
		}
	}
</script>

<style>
	ul{
		padding:0px;
	}

	.li-item{
		margin-bottom:10px;
		padding: 4px;
		background: transparent;
		background: rgba(0, 0, 0, 0.1);
		border: 1px solid #d2d6de;
		border-radius: 6px;
	}

</style>