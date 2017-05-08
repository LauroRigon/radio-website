<template>
<div id="user-component">
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    <ul class="nav nav-pills nav-stacked">
      <li role="presentation" class="[(tab == 'profile')? active]"><a href="#">Perfil</a></li>
      <li role="presentation"><a href="#">Senha</a></li>
    </ul>
  </div>
  
  <div class="col-lg-8" id="component-content" v-show="tab == 'profile'">
    <div class="box box-primary">
      <div id="profile">
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username" v-text="user.name"></h3>
              <span class="label label-danger" v-show="user.is_master">Master</span>
            </div>
            <div class="widget-user-image">                
                <img class="img-circle" :src="user.avatar" alt="User Avatar">
            </div>
            <div class="overlay" v-show="isLoading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border">
                  <div class="description-block">
                    <h5 class="description-header" v-text="user.id"></h5>
                    <span class="description-text">Id</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border">
                  <div class="description-block">
                    <h5 class="description-header" v-text="user.email"></h5>
                    <span class="description-text">Email</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header" v-text="user.created_date"></h5>
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
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: [
    'user-api', 'post-avatar'
  ],
  data() {
    return {
        user: {
          name: '',
          email: '',
          avatar: '',
          created_date: '',
          is_master: ''

        },
        isLoading: true,
        image: '',
        tab: 'profile'
    }
  },

  mounted() {
    axios.get(this.userApi)
      .then(function(serverResponse) {
        this.user = serverResponse.data[0];

        this.isLoading = false;
      }.bind(this))
      .catch(function(error) {
        console.log(error.response)
        toastr.error("Ocorreu um erro ao tentar encontrar usuário!");
      });
  },

  methods: {
    
  }
}
</script>

<style>
#user-component {
  margin-top: 10px;
}

#profile {
  margin-top: 5px;
}
</style>


    