<template>
    <div>
        
        <div class="fixed-action-btn">
            <!--<div class="ui popup top right transition visible" style="bottom: 130px; height:60px;">
                <div class="header" style="font-size: 14px">Pedir música!</div>                                
            </div>
            -->
            <a id="menu" class="waves-effect waves-light btn btn-floating btn-large" :class="[isOpen ? 'yellow-radio' : 'purple-radio']" style="heigth:180px" @click="toggleContent()"><i class="material-icons">music_note</i></a>
        </div>

        
            <div class="tap-target-wrapper open" v-show="isOpen" @keyup.esc="toggleContent()">
                
                <!-- Click out side area -->
                <div class="out-side-area" @click="toggleContent()"></div>

                <transition name="scale-transition"
                    enter-active-class="animated zoomIn"
                    leave-active-class="animated zoomOut">
                    <div class="tap-target" data-activates="menu" v-show="isOpen">
                        <div class="tap-target-content white-text">
                            <h5 class="center-align">Pedir música</h5>
                            <form class="col s12">
                                <div class="row" style="margin-bottom:0px;">
                                    <div class="input-field col m12 s8" style="margin-top:0px;">
                                        <textarea id="content" class="materialize-textarea" v-model="order.content" style="margin-bottom: 0px"></textarea>
                                        <label for="content">Escreva seu pedido aqui!</label>
                                        <span class="error" v-show="this.contentEmpty">Esse campo é obrigatório!</span>
                                    </div>

                                    <div class="input-field col m12 s8" >
                                        <input id="name" type="text" v-model="order.name">
                                        <label for="name" class="">Seu nome</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <a class="waves-effect waves-light btn yellow-radio" @click="sendOrder()">Enviar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </transition>
                
            </div>
        
    </div>
</template>

<script>
import { isEmpty } from 'lodash'
import { http } from '../../../services'

export default {
    data() {
        return {
            isOpen: false,
            order: {
                name: '',
                content: ''
            }
        }
    },
    created() {
        //$('.tap-target').on('click.tapTarget', function(){console.log('dadas')})
    },

    computed: {
        contentEmpty() {
            if(isEmpty(this.order.content)){
                return true
            }else{
                return false
            }
        }
    },

    methods: {
        openContent() {
            $('.tap-target').tapTarget('open')
        },

        toggleContent() {
            this.isOpen = !this.isOpen
        },

        sendOrder() {
            if(this.contentEmpty){
                return false;
            }

            http.post('musicOrder/store', this.order)
            .then(( response ) => {
                Materialize.toast('Pedido efetuado com sucesso!', 4000)
                this.order.name = ''
                this.order.content = ''
            })
            .catch(( {response} ) => {
                if(response.status === 422){
                    Materialize.toast(response.data, 4000)
                }
            })
        }
    }
}
</script>

<style>
.fixed-action-btn {
    bottom: 70px; 
    right: 24px;
    z-index: 1000;
}

.tap-target-content {
    width: 456px; 
    height: 400px; 
    top: 85px; 
    right: 0px; 
    bottom: 0px; 
    left: 0px; 
    padding: 56px; 
    vertical-align: bottom;
}

.tap-target {
    background-color: #322C53;
}

.tap-target-wave {
    top: 40%; 
    left: 43%; 
    width: 112px; 
    height: 112px;
}

@media screen and (max-width: 600px) {
    .tap-target-wave {
        top: 35%; 
        left: 38%; 
        width: 70px; 
        height: 70px;
    }

    .tap-target-wrapper {
        right: -348px; 
        bottom: -327px; 
        position: fixed;
        height: 700px;
        width: 700px;
    }

    .tap-target-content {
        width: 456px; 
        height: 400px; 
        top: 55px; 
        right: 0px; 
        bottom: 0px; 
        left: 0px; 
        padding: 56px; 
        vertical-align: top;
    }
}

.tap-target-wrapper {
    right: -348px; 
    bottom: -327px; 
    position: fixed;
    z-index: 900
}

.out-side-area {
    position: fixed;
    z-index: -999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    height: 100%;
    width: 100%;
}

.error { 
    color: #d32f2f;
    size: 13px;
}
</style>
