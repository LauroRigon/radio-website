<template>
<transition
    name="custom-classes-transition"
    enter-active-class="animated fadeIn"
    >
<div class="modal" style="display: block" v-show="isVisible">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" v-text="title"></h4>
      </div>

      <div class="modal-body">
        <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <!-- text input -->
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" placeholder="Nome do usuário" v-model="user.name">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control" placeholder="Email do usuário" v-model="user.email">
                </div>

                <div class="form-group">
                  <label for="password">Senha</label>
                  <input type="password" id="password" class="form-control" placeholder="Senha do usuário" v-model="user.password">
                </div>

                <div class="checkbox">
                  <label>
                    <input type="checkbox" v-model="user.is_master"> Master
                  </label>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" @click="closeModal">Cancelar</button>
        <button type="button" class="btn btn-primary" @click.prevent="sendForm">Confirmar</button>
      </div>
    </div>
  </div>
</div>
</transition>
</template>

<script>
export default {
  props: [
  'title'
  ],
  data() {
    return{
      isVisible: false,
      isLoading: false,
      user: {
        name: '',
        email: '',
        password: '',
        is_master: false
      }
    }
  },

  created() {
    Event.$on("open-create-modal", function(data){
      this.isVisible = true;
      this.isLoading = true;
    }.bind(this));
  },
  mounted() {
    //event listener para sair com o esc do modal
    window.addEventListener('keyup', function(event) {
        // If esc was pressed...
        if (event.keyCode == 27) { 
          this.closeModal();
        }
    }.bind(this))
  },

  methods: {
    closeModal: function() {
      this.isVisible = false;
    },

    sendForm: function() {
      var userData = this.user;
      userData.is_master = (userData.is_master == false)? "0" :"1";
      axios.post('users/create', userData)
      .then(function(response) {
        console.log(response);
        toastr.success("Usuário criado com sucesso!");
      })
      .catch(function(error) {
        console.log(error.response)
      });
    }
  }
}
</script>


    