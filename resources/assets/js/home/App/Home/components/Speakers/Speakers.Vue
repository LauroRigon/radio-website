<template>
<div class="row">
    <template v-for="speaker in speakers">
        <div class="col m3" :key="speaker.id">
            <div class="card-panel grey lighten-5 z-depth-1">
            <div class="row valign-wrapper">
                <div class="col s12">
                    <img :src="speaker.avatar" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                </div>
            </div>
            <div class="row center-align">
                <h5>{{ speaker.name }}</h5>
            </div>
            </div>
        </div>
    </template>
</div>
</template>

<script>
import { http } from '../../../../services'
import { mapActions } from 'vuex'

export default {
    data() {
        return {
            speakers: []
        }
    },

    created() {
        this.getSpeakers()
    },

    methods: {
        getSpeakers() {
            http.get('speakers/')
            .then(({ data }) => {
                this.hideLoader()
                this.speakers = data
            })
        },

        ...mapActions([
            'hideLoader'
        ]),
    }
}
</script>

<style>

</style>

