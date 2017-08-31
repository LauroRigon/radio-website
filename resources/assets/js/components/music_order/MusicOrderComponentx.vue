<template>
<div>
	<div class="row chat-window hidden-xs col-md-3 col-sm-4 col-md-offset-9">
        <div class="col-xs-12 col-md-12">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar" @click.prevent="collapse()">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="fa fa-music"></span> Pedir música!</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span class="glyphicon glyphicon-minus icon_minim"></span></a>
                    </div>
                </div>
                <div id="msg-panel-body" class="panel-body msg_container_base" v-show="!collapsed">
                    <div class="row msg_container base_sent" v-for="message in oldMessages" v-bind:key="message.id">
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent">
                                <p v-text="message.content"></p>
                                <time v-text="message.created_at"></time>
                            </div>
                        </div>
                    </div>
					<transition name="error-transition"
						enter-active-class="animated fadeIn"
						leave-active-class="animated fadeOut"
						duration="200"
					>
						<div v-if="error" class="panel-error" v-text="error"></div>
					</transition>
                </div>
                <div class="panel-footer" v-show="!collapsed">
                	<div class="input-group">
                	<label >Nome:</label>
                		<input type="text" class="form-control input-sm chat_input col-md-1" placeholder="Escreva seu nome aqui..." v-model="message.name">
                	</div>
                    <div class="input-group">
                        <input type="text" class="form-control input-sm chat_input" placeholder="Escreva seu pedido aqui..." v-model="message.content" @keydown.enter="sendOrder()">
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendOrder()" :disabled="isLoading"><i class="fa fa-refresh fa-spin" v-show="isLoading"></i> Enviar</button>
                        </span>
                    </div>
                </div>
    		</div>
        </div>
    </div>
</div>
</template>

<script>
	export default{
		props: {
			sendOrderApi: {
				type: String,
				required: true
            },
		},

		data() {
			return {
				message: {
					name: '',
					content: ''
				},
				oldMessages: [],
				collapsed: true,
				error: null,
				isLoading: false
			}
		},

		created(){
			if(Cookies.getJSON('oldMusicOrders') != null){
				this.oldMessages = Cookies.getJSON('oldMusicOrders');
			}
		},

		methods: {
			sendOrder() {
				if(this.message.content == ''){
					this.error = "Digite seu pedido no campo abaixo!";
					return false;
				}
				this.isLoading = true;
				axios.post(this.sendOrderApi, this.message)
				.then(function(response) {
					this.isLoading = false;
					this.error = null;
					this.oldMessages.push(response.data);
					Cookies.set('oldMusicOrders', this.oldMessages);
				}.bind(this))
				.catch(function(error){
					this.error = error.response.data[0];
					this.isLoading = false;
				}.bind(this))
			},

			collapse() {
				if(this.collapsed){
					this.collapsed = false;
				}else{
					this.collapsed = true;
				}
			}
		}
	}
</script>