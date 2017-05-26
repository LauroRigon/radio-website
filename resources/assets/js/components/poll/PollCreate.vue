<template>
<div>
	<form @submit.prevent=''>
		<div class="form-group col-md-6">
			<div class="row">
				<div class="form-group col-md-8">
					<label for='title'>Título</label>
					<input type="text" class="form-control" id='title' name="title" placeholder="Digite o título da votação aqui" v-model="poll.title">
				</div>

			</div>

		<label>Opções da votação</label>
			<ul>
				<li v-for="option in poll.options" v-text="option"></li>
				
				<div class="input-group">
					<input  type="text" class="form-control" name="option" placeholder="Digite uma opção para a votação aqui" v-model="optionField" @keyup.enter="addOption">
					<span class="input-group-btn">
                      <button type="button" class="btn btn-info" @click="addOption">Adicionar!</button>
                    </span>
                </div>
			</ul>
			<div class="form-group">
				<button type="button" class="btn btn-primary" @click="sendForm"><i class="fa fa-refresh fa-spin" v-show="isLoading"></i> Enviar</button>

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
				isLoading: false
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
				})

				this.isLoading = false;
			},

			clearFields: function() {
				this.poll.title = '';
				this.poll.options = [];
			}
		}
	}
</script>

<style>
	ul{
		padding:0px;
	}

</style>