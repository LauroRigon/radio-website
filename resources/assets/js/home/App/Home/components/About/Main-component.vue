<template>
    <div class="row">
        <div class="col m12">
            <div class="card">
                <div class="row">
                    <h1 class="center-align">{{ post.title }}</h1>
                </div>
                <div class="card-image">
                    <img :src="post.thumbnail">
                </div>
                <div class="post-content">
                    <div v-html="post.content">
                        
                    </div>
                    <gallery :post-gallery="post.galleries"></gallery>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { http } from '../../../../services'
import { mapActions } from 'vuex'
import Gallery from '../Post/Gallery'

	export default {
        components: { Gallery },

		data() {
			return {
				post: {}
			}
        },
        
        methods: {
            ...mapActions(['hideLoader']),

            getAbout(){
                http.get('posts/getAbout')
                .then(({ data }) => {
                    this.post = data
                    this.hideLoader()
                })
            }
        },

        created() {
            this.getAbout()
        }
	}
</script>

<style>
.post-content {
    margin: 10px;
}
</style>
