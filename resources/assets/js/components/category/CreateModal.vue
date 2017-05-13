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
              <form role="form" @keydown="clearError($event.target.name)" @keyup.enter.prevent="">
                <div class="form-group" :class="{'has-error': getError('name')}">
                  <label>Nome</label>
                  <input type="text" class="form-control" placeholder="Nome da categoria" v-model="category.name" name="name">
                  <span class="help-block" v-text="getError('name')" v-if="getError('name')"></span>
                </div>

                <div class="form-group" :class="{'has-error': getError('description')}">
                  <label for="description">Descrição</label>
                  <textarea id="description" class="form-control" rows="3" placeholder="Descrição da categoria" v-model="category.description" name="description"></textarea>
                  <span class="help-block" v-text="getError('description')" v-if="getError('description')"></span>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" @click="closeModal">Cancelar</button>
        <button type="button" class="btn btn-primary" @click.prevent="sendForm"><i class="fa fa-refresh fa-spin" v-show="isLoading"></i> Confirmar</button>
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
      category: {
        name: '',
        description: ''
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

      axios.post('categories/create', this.category)
      .then(function(serverResponse) {
        this.appendToTable(serverResponse.data)

        this.isLoading = false
        this.clearFields();

        toastr.success("Categoria criada com sucesso!");      
      }.bind(this))

      .catch(function(error) {
        console.log(error.response)
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
      this.category.description = '';
      this.category.name = '';
    },

    appendToTable: function(categoryd) {
      Event.$emit('set-new-tdata', {
        id: categoryd.id, 
        name: categoryd.name, 
        description: categoryd.description,
        created_date: categoryd.created_date
      });
    }
  }


}
</script>


    