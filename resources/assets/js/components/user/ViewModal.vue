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
        <h4 class="modal-title">{{title}}</h4>
      </div>

      <div class="modal-body">
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username" v-text="data.name"></h3>
              <span class="label label-danger" v-show="data.is_master == 'Sim'">Master</span>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" :src="data.avatar" alt="User Avatar">
            </div>
            <div class="overlay" v-show="isLoading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header" v-text="data.post_count"></h5>
                    <span class="description-text">Posts</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header" v-text="data.email"></h5>
                    <span class="description-text">Email</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header" v-text="data.created_at"></h5>
                    <span class="description-text">Data do cadastrado</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="closeModal">Fechar</button>
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
      data: []
    }
  },
  created() {
    Event.$on("open-view-modal", function(data){
      this.isVisible = true;
      this.isLoading = true;
      this.getData(data.id);
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

    getData(user) {
      axios.get("users/getUserComplete/" + user)
      .then(function(serverResponse) {
        this.data = serverResponse.data[0];

        this.isLoading = false;
      }.bind(this))
      .catch(function() {
        toastr.error("Ocorreu um erro ao tentar encontrar usuário!");
      });
    }
  }
}
</script>


    