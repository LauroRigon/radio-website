<template>
	<div class="panel panel-default poll">
        <div class="panel-heading">
            <i class="fa fa-edit"></i> Enquete
        </div>
		<transition name="error-transition"
					enter-active-class="animated fadeIn"
					leave-active-class="animated fadeOut"
					duration="200"
		>
			<div v-if="error" class="panel-error" v-text="error"></div>
		</transition>
        <template v-if="poll.canVote">
	        <div class="panel-body">
	            <h5 v-text="poll.title"></h5>
	            <form>
	                <div class="radio" v-for="option in poll.options" v-bind:key="option.id">
	                    <label><input type="radio" name="poll" :value="option.id" v-model="optionChosen">{{option.name}}</label>
	                </div>
	            </form>
	        </div>
	        <div class="panel-footer">
	            <a class="btn btn-primary" @click="sendVote()" :disabled="isLoading"><i class="fa fa-refresh fa-spin" v-show="isLoading"></i> Votar</a>
	        </div>
	    </template>
	    <template v-else>
	    	<div class="panel-body">
	            <h5 v-text="poll.title"></h5>
	                <div class="radio" v-for="option in poll.options" v-bind:key="option.id">
	                <span><strong>{{ option.name }}</strong></span>
	                    <div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" :style="{width:  calcPercent(option.vote_count, poll.votesSum) + '%'}">
							{{ calcPercent(option.vote_count, poll.votesSum) + '%'}}
							</div>
						</div>
	                </div>
	                <div class="row" style="padding-left: 14px; padding-right: 14px;">
	                	<span>Total de votos:</span> <span v-text="poll.votesSum" class="pull-right"></span>
                	</div>
	        </div>
	    </template>
    </div>
</template>

<script>
	export default {
		props: {
			getPollApi: {
				type: String,
				required: true
			},
			sendOptionApi: {
				type: String,
				required: true
			}
		},

		data() {
			return {
				poll: {},
				optionChosen: null,
				isLoading: false,
				error: null
			}
		},

		created() {
			this.getPoll();
		},

		methods: {
			getPoll() {
				this.isLoading = true;
				axios.get(this.getPollApi)
				.then(function(response){
					this.poll = response.data;
					this.error = false;
					this.isLoading = false;
				}.bind(this))
			},

			sendVote() {
				this.isLoading = true;
				axios.post(this.sendOptionApi, {optionChosen: this.optionChosen})
				.then(function(response){
					this.getPoll();
					this.isLoading = false;
				}.bind(this))
				.catch(function(error){
					switch(error.response.status){
						case 422:
							this.error = 'Você não escolheu uma opção!';
						break;
					}
					this.isLoading = false;
				}.bind(this));
			},

			calcPercent(val, total) {
				return ((val/total)*100).toFixed(2);
			}
		}
	}
</script>