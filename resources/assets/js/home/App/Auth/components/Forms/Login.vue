<template>
    <div class="row">
        <div class="col s8 m6 offset-m3 offset-s1">
            <div class="card z-depth-4" id="loginCard">
                <div class="card-content">
                    <span class="card-title text-darken-4 center-align">Fazer login</span>
                    <div class="row">
                        <div class="col m10 offset-m1">
                            <div class="row">
                                <div class="input-field ">
                                    <input id="email" type="email" v-model="user.email"/>
                                    <label for="email">Digite seu email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field ">
                                    <input id="password" type="password" v-model="user.password"/>
                                    <label for="password">Digite sua senha</label>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn waves-effect waves-light right" :disabled="!isValid" @click="doLogin">
                                    Entrar<i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { isEmpty } from 'lodash'
import { mapActions } from 'vuex'
import { authPersistence } from '../../../../services'

export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            }
        }
    },

    methods: {
        ...mapActions([
            'attemptLogin'
        ]),

        doLogin() {
            this.$Progress.start()
            
            this.attemptLogin(this.user)
                .then(() => {
                    this.$router.push({name: 'dashboard'})
                    this.$Progress.finish()
                    
                    Materialize.toast('Login efetuado com sucesso!', 2000)
                })

                .catch((error) => {
                    this.$Progress.fail()
                    console.log(error);
                    Materialize.toast('Usuário ou senha incorreto!', 4000)
                })
            
        }
    },

    computed: {
        isValid () {
            const user = this.user
            return !isEmpty(user.email) && !isEmpty(user.password)
        }
    }
}
</script>

<style>
#loginCard {
    margin-top: 100px;
}
</style>
