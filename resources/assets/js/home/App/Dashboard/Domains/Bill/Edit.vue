<template>
<div class="row">
    <router-link :to="{name: 'users'}" class="btn blue"><i class="material-icons">chevron_left</i></router-link>
  <form @keydown="clearError($event.target.name)">
    <div class="row">
        <div class="input-field col s6">
            <i class="material-icons prefix">account_circle</i>
            <input id="name" type="text" name="name" class="validate" :class="getError('name')? 'invalid': ''" v-model="user.name">
            <span class="red-text" v-if="getError('name')" style="margin-left: 15%">{{ getError('name') }}</span>
            <label for="first_name"> Nome</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s6">
            <i class="material-icons prefix">email</i>
            <input type="email" id="email" name="email" class="validate" v-model="user.email">
            <span class="red-text" v-if="getError('email')" style="margin-left: 15%">{{ getError('email') }}</span>
            <label for="email" data-error="Inválido" data-success="Correto">Email</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s6">
            <i class="material-icons prefix">enhanced_encryption</i>
            <input type="password" id="password" name="password" class="validate" v-model="user.password">
            <span class="red-text" v-if="getError('password')" style="margin-left: 15%">{{ getError('password') }}</span>
            <label for="password">Senha</label>
        </div>

        <div class="input-field col s6">
            <input type="password" id="password_confirmation" name="password_confirmation" v-model="password_confirmation">
            <span class="red-text" v-if="!passwordConfirmation">As senha não são iguais!</span>
            <label for="password_confirmation">Confirme a senha</label>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <input id="isadmin" name="isAdmin" type="checkbox" :checked="user.isAdmin? 'checked': ''" v-model="user.isAdmin">
            <label for="isadmin">Admin?</label>
        </div>
        
        <div class="preloader-wrapper small active right" v-show="isLoading">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <button class="btn waves-effect waves-light right" @click.prevent="sendForm()">Atualizar
            <i class="material-icons right">send</i>
        </button>
    </div>
  </form>
</div>
</template>

<script>
import { http } from '../../../../services'

    export default {
        data(){
            return {
                isLoading: false,
                errors: [],
                user: {
                    name: '',
                    email: '',
                    isAdmin: true,
                    password: ''
                },
                password_confirmation: ''
            }
        },

        props: [
            'user_id'
        ],

        computed: {
            passwordConfirmation() {
                if(this.user.password !== this.password_confirmation && this.password_confirmation !== ""){
                    return false;
                }else{
                    return true;
                }
            }
        },

        created(){
            http.get('/dashboard/users/edit/' + this.user_id)
            .then(function(response) {
                this.user.name = response.data.name;
                this.user.email = response.data.email;
                this.user.isAdmin = response.data.isAdmin;

                 $(document).ready(function() {
                    Materialize.updateTextFields();
                });
            }.bind(this))
        },

        methods: {
            sendForm(){
                this.$Progress.start()
                this.isLoading = true;
                http.put('/dashboard/users/update/' + this.user_id, this.user)
                .then(function(response){
                    Materialize.toast("Usuário atualizado com sucesso!", 5000);
                    this.$Progress.finish()

                    this.$router.push({name: 'users'});
                }.bind(this))
                .catch(function(error){
                    this.$Progress.fail()
                    this.errors = error.response.data;
                    this.isLoading = false;
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
                delete this.errors[error];
            },

            clearFields: function() {
                this.user.lastName = '';
                this.user.firstName = '';
                this.user.email = '';
                this.user.password = '';
                this.user.password_confirmation = '';
            },
        }
    }
</script>