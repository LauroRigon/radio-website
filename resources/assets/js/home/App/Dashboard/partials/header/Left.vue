<template>
    <ul id="nav-mobile" class="side-nav fixed">
        <user-view></user-view>
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
            <li class="bold" v-for="(menu, index) in menus" :key="index">
                <router-link :to="menu.uri" v-if="!menu.dropdown" 
                            tag="li" 
                            exact>
                    <a class="waves-effect waves"><i class="material-icons">{{ menu.icon }}</i>{{ menu.label }}</a>
                </router-link>

                <a v-if="menu.dropdown" class="collapsible-header waves-effect waves"><i class="material-icons">{{ menu.icon }}</i>{{ menu.label }}</a>
                <div class="collapsible-body">
                    <ul>
                        <router-link :to="subMenu.uri" 
                                    v-for="(subMenu, index) in menu.subMenus" 
                                    :key="index"
                                    tag="li">
                            <a class="waves-effect waves"><i class="material-icons">{{ subMenu.icon }}</i>{{ subMenu.label }}</a>
                        </router-link>
                    </ul>
                </div>
            </li>
          </ul>
        </li>
    </ul>
</template>

<script>
import UserView from './UserView.vue'

import menus from '../../../../configs/menus.js'

export default {
    components: { UserView },
    
    data() {
      return {
        menus: menus
      }
    },

    mounted() {
        $( document ).ready(function() {
            $('.collapsible').collapsible({
                accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
            });

            $('.button-collapse').sideNav({
                closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                draggable: true, // Choose whether you can drag to open on touch screens,
            });
        });
    }
}
</script>

