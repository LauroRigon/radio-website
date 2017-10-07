<template>
	<div class="row">
		<div class="col m12">
			<div class="card">
				<div class="card-header z-depth-2">
					Enquete
				</div>
				<div class="card-content black-text">
					<span class="card-title"> {{ poll.title }} </span>

					<!-- OVERLAY WITH PRELOADER-->
					<div class="overlay valign-wrapper" v-show="isLoading">
						<div class="col m4 offset-m4">
							<div class="preloader-wrapper big active">
								<div class="spinner-layer spinner-blue-only">
								<div class="circle-clipper left">
									<div class="circle"></div>
								</div><div class="gap-patch">
									<div class="circle"></div>
								</div><div class="circle-clipper right">
									<div class="circle"></div>
								</div>
								</div>
							</div>
						</div>
					</div>
					<!-- OVERLAY WITH PRELOADER END-->
					<template v-if="poll.canVote">
						<form>
							<p v-for="option in poll.options" :key="option.id">
								<input :id="option.id" name="option" type="radio" 
								v-model="selectedOption"
								:value="option.id"/>

								<label class="black-text" :for="option.id">{{ option.name }}</label>
							</p>
						</form>
						<div class="card-action center">
							<button class="btn waves-effect" @click="attemptVote()">Votar</button>
							<blockquote v-if="this.error">
								<p class="red-text">{{ this.error }}</p>
							</blockquote>
						</div>
					</template>
					<template v-else>
						<div class="row">
						<template v-for="option in poll.options">
								<div class="col m10" :key="option.id">
									<label class="truncate">{{ option.name }}</label>
									<div class="progress" :key="option">								
										<div class="determinate" :style="{width: calcPercent(option.vote_count, sumVotes(poll.options)) + '%'}">
										</div>
									</div>
									
								</div>
								<div class="col m2 result-num right" :key="option.id">
									<span class="badge">
									{{ option.vote_count }}
									</span>
								</div>
						</template>
						</div>
						<div class="row">
							<div class="col m8">
								<p>
									Total:
								</p>
							</div>

							<div class="col m4">
								<p class="right">
									{{ sumVotes(poll.options) }}
								</p>
							</div>
						</div>
					</template>
				</div>
				
			</div>
		</div>
	</div>
</template>

<script>
import { http } from '../../../../services'
import { isEmpty } from 'lodash'

	export default {
		data() {
			return {
				selectedOption: '',
				isLoading: false,
				poll: this.pollData,
				error: false
			}
		},

		props:{
			pollData: {
				type: Object,
				required: true
			}
		},

		methods: {
			attemptVote() {
				if(this.selectedOption == ''){
					this.error = "Selecione uma opção para votar!"
					return false
				}

				this.isLoading = true
				http.post('/polls/addVote', {
					pollId: this.poll.id,
					optionChosen: this.selectedOption
				})
				.then( (response) => {
					this.isLoading = false
					this.reloadPoll()
				})
				.catch( (error) => {
					Materialize.toast("Desculpe, ocorreu um erro ao efetuar esta operação!", 5000)
					this.isLoading = false
				})
			},

			reloadPoll() {
				http.get('polls/getPoll/' + this.poll.id)
				.then( ({data}) => this.poll = data )
			},

			sumVotes(options) {
				var sum = 0
				options.forEach((op) => {
					sum += op.vote_count
				})
				return sum
			},

			calcPercent(val, total) {
				return ((val/total)*100).toFixed(2);
			}
		}
	}
</script>

<style>
.overlay {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	z-index: 10;
	background-color: rgba(0,0,0,0.2);
}

.card-header{
	color: white;
	background-color: #322C53;
	padding: 15px 0 15px 0;
}

.card-title{
	padding-top:10px!important;
	font-size: 20px !important;
}

.result-num {
	padding-top: 15px !important;
}
</style>
