/*
*
*DIREFENTES SLOTS PARA POR CONTEUDO
*BOX TRANSFORMADO EM COMPONENT
*/


/*
*Componente de login
*/
Vue.component('login-box', {
  template:`
    <div class="row" id="loginBox">
      <div class="col-lg-4 centered text-center" id="box">
        <form action="" method="post" name="Login_Form" class="form-signin">       
          <h3>Login</h3>
        <input type="text"  class="form-control" name="name" placeholder="Name" v-model="name" required/>
        <input type="text"  class="form-control" name="email" placeholder="Email" v-model="email" required/>
        <input type="password" class="form-control" name="password" placeholder="Password" required v-model="password"/>
        <input type="file" class="form-control" name="avatar"
        @change="onFileChange"/>

        <button class="btn btn-lg btn-primary btn-block" name="Submit" value="Login" 
        v-on:click.prevent="sendForm"
        :disabled="isLoading"><i :class="{'fa fa-circle-o-notch fa-spin' : isLoading}"></i>{{buttonText}}</button>
        <button class="btn btn-danger" 
        v-if="isLoading" 
        v-on:click.prevent="cancelRequest"> Cancel </button>        
        </form>   
      </div>
    </div>
  `,


  data(){
    return {
      name: '',
      email: '',
      password: '',
      buttonText: 'Send',
      isLoading: false,
      avatar: ''
    }
  },


  methods: {
    sendForm: function() {
      if(this.email != '' && this.password != ''){
          this.isLoading = true;
          this.buttonText = ' Loading...';
          axios.post('admin/users', {
            name: this.name,
            email: this.email,
            password: this.password,
            avatar: this.avatar

          }).then(function (response) {
            console.log(response);


          }).catch(function (error) {
            console.log(error);
          })
      }
    },


    cancelRequest: function() {
      this.isLoading = false;
      this.buttonText = 'Send';
    },


    onFileChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.createImage(files[0]);
    },


    createImage(file) {
      var avatar = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.avatar = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  }
});


var logBox = new Vue({
  el: "#root",
  data:{
    showModal: false
  }

})