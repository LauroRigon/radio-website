<template>
<div v-show="isVisible">
	<div class="row">
        <div class="col-4 pull-right">
            <div class="box box-solid" style="padding:5px">
                <div class="btn-group">
                	<a class="btn btn-success" @click="sendApprove()" :disabled="sendingPost"><i :class="sendingPost? 'fa fa-refresh fa-spin': 'glyphicon glyphicon-ok'"></i> Aprovar</a>
                	<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" @click="toggleDropdown()">Reprovar <i class="fa" :class="dropdownActive? 'fa-caret-up': 'fa-caret-down'"></i></a>
                	<a class="btn btn-danger" @click="deletePost()"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row" v-show="dropdownActive">
        <div class="form-group col-md-6 col-sm-8 col-xs-8 pull-right well" style="padding-top:2px">
			<div class="pull-right">
            	<button type="button" class="btn btn-box-tool" @click="toggleDropdown()"><i class="fa fa-times" style="font-size: 16px"></i></button>
          	</div>
          	<h4>Reprovar postagem</h4>
    		<label for='note'>Observação*: </label>
    		<textarea class="form-control" rows="4" placeholder="Coloque uma observação aqui!" v-model="message"></textarea>
			<a class="btn btn-primary pull-right" style="margin-top: 5px" @click="sendDisapprove()" :disabled="sendingPost || disapproveDisabled"><i class="fa fa-refresh fa-spin" v-show="sendingPost"></i> Concluir</a>
    	</div>
    </div>

</div>
</template>

<script>
	export default {
		props: {
            approveApi: {
                type: String
            },
            disapproveApi: {
                type: String
            },
            deletePostApi: {
                type: String
            }
		},

		data(){
			return {
				dropdownActive: false,
				disapproveDisabled: false,
				sendingPost: false,
				isVisible: true,
				message: ''
			}
		},

		methods: {
			toggleDropdown() {
				this.dropdownActive = !this.dropdownActive;
			},

			sendDisapprove() {
				this.sendingPost = true;
				axios.post(this.disapproveApi, {message: this.message})
				.then(function(response) {
					toastr.success(response.data.status);
					this.sendingPost = false;
					this.disapproveDisabled = true;
				}.bind(this))
				.catch(function(response) {
					toastr.error('Ocorreu um erro ao reprovar postagem!');
					console.log(response);
					this.sendingPost = false;
				}.bind(this));
			},

			sendApprove() {
				this.sendingPost = true;
				axios.post(this.approveApi)
				.then(function(response) {
					toastr.success(response.data.status);
					this.isVisible = false;
					this.sendingPost = false;
				}.bind(this))
				.catch(function(response) {
					toastr.error('Ocorreu um erro ao publicar!');
					console.log(response);
					this.sendingPost = false;
				});
			},

			deletePost() {
				console.log(window.location);
                jConfirm.confirm("Tem certeza de deletar essa postagem permanentemente?", function(confirmation){
                  if(confirmation){
                    axios.delete(this.deletePostApi)
                    .then(function(response) {
                      toastr.success(response.data['status']);

                      window.location.href = window.location.origin + '/admin/posts/pending';
                    }.bind(this))
                    .catch(function(error){
                      if(error.response.status == 500){
                        toastr.warning("Item tem dependências cadastradas!")
                      }else{
                        toastr.error(error.response.data['status'], "Ocorreu um erro ao deletar!")
                      }
                    });

                  }
                }.bind(this));
              }
		}
	}
</script>