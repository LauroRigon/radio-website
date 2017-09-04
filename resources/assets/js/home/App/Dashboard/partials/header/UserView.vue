<template>
<li>
    <div class="row">
        <div class="blue lighten-1 center-align white-text">
            <div class="row">
                <router-link :to="{name: 'change.avatar'}"><img class="circle hoverable" height="80px" src="https://image.freepik.com/free-icon/male-user-silhouette_318-35708.jpg"></router-link>
            </div>
            <div class="row">
                <h5>{{ user.name }}</h5>
            </div>
            <div class="row">
                <h6>{{ user.email }}</h6>
            </div>
        </div>
    </div>
</li>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    data() {
        return {
            user: {}
        }
    },

    created() {
        this.user = this.getUserLogged
    },

    computed: {
        ...mapGetters([
            'getUserLogged'
        ])
    }
}
</script>

