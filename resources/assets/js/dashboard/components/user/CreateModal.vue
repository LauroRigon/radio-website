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
              <form role="form" @keydown="clearError($event.target.name)" @keyup.enter="sendForm">
                <div class="form-group" :class="{'has-error': getError('name')}">
                  <label>Nome</label>
                  <input type="text" class="form-control" placeholder="Nome do usuário" v-model="user.name" name="name">
                  <span class="help-block" v-text="getError('name')" v-if="getError('name')"></span>
                </div>

                <div class="form-group" :class="{'has-error': getError('email')}">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control" placeholder="Email do usuário" v-model="user.email" name="email">
                  <span class="help-block" v-text="getError('email')" v-if="getError('email')"></span>
                </div>

                <div class="form-group" :class="{'has-error': getError('password')}">
                  <label for="password">Senha</label>
                  <input type="password" id="password" class="form-control" placeholder="Senha do usuário" v-model="user.password" name="password">
                  <span class="help-block" v-text="getError('password')" v-if="getError('password')"></span>
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
        <button type="button" class="btn btn-primary" @click.prevent="sendForm" :disabled="isLoading"><i class="fa fa-refresh fa-spin" v-show="isLoading"></i> Confirmar</button>
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
      },
      errors: []
    }
  },

  created() {
    Event.$on("open-create-modal", function(data){
      this.isVisible = true;
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
      this.isLoading = true

      axios.post('users/create', this.user)
      .then(function(serverResponse) {

        this.isLoading = false
        this.clearFields();

        this.updateTable();
        toastr.success("Usuário criado com sucesso!");      
      }.bind(this))

      .catch(function(error) {
        this.errors = error.response.data;
        this.isLoading = false
      }.bind(this));
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
    },

    clearFields: function() {
      this.user.email = '';
      this.user.name = '';
      this.user.is_master = false;
      this.user.password = '';
    },

    updateTable() {
      Event.$emit('reload-table');
    }
  }


}
</script>


    