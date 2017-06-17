<template>
	<div>
		<div class="row">
			<form>
				<div class="form-group col-md-5">
					<label for='name'>Nome do programa:</label>
					<input type="text" id="name" name="name" class="form-control" v-model="program.name">
				</div>

				<div class="form-group col-md-3">
					<label for='type'>Gênero do programa:</label>
					<input type="text" id="type" name="type" class="form-control" v-model="program.type">
				</div>

				<div class="form-group col-md-5">
					<label for='type'>Dia da semana:</label>
					<select class="form-control" name="day_of_week" v-model="program.day_of_week">
						<option value='segunda-feira' selected>Segunda-feira</option>
						<option value='terca-feira'>Terça-feira</option>
						<option value='quarta-feira'>Quarta-feira</option>
						<option value='quinta-feira'>Quinta-feira</option>
						<option value='sexta-feira'>Sexta-feira</option>
						<option value='sabado'>Sábado</option>
						<option value='domingo'>Domingo</option>
					</select>
				</div>
				<div class="form-group col-md-5">
				<label for="time">Horário:</label>
					<input type="text" class="form-control timepicker" id="time" name="time" v-model="program.time">
				</div>
			</form>
		</div>
		<div class="box-footer">
			<button type="button" class="btn btn-primary" @click="sendForm" :disabled="isLoading"><i class="fa fa-refresh fa-spin" 
			v-show="isLoading"></i> Concluir</button>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			postProgrammingApi: {
				type: String,
				required: true
			}
		},

		data() {
			return {
				program: {
					name: '',
					type: '',
					day_of_week: '',
					time: ''
				},
				isLoading: false
			}
		},

		mounted() {
			$(function () {
			    //Timepicker
			    $(".timepicker").timepicker({
			      showInputs: false,
			      minuteStep: 10,
			      showMeridian: false,
			      explicitMode: true
			    });
			  });
		},

		methods: {
			sendForm() {
				this.program.time = $('#time').val();
				axios.post(this.postProgrammingApi)
			}
		}
	}
</script>