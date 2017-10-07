<template>
    <div class="row">
        <div class="col m12">
            <div class="card">
                <div class="row">
                    <h1 class="center-align">{{ post.title }}</h1>
                </div>
                <div class="row">
                    <div class="col m12">
                        <p class="text-faded center-align"><i class="tiny material-icons">dehaze</i>Categoria: {{ post.category_id }} | <i class="tiny material-icons">face</i>Publicado por: {{ post.user.name }} <i class="tiny material-icons">access_time</i>Publicado em: {{ post.published_at }}</p>
                    </div>
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
import Gallery from './Gallery'

	export default {
        components: { Gallery },
        props: ['post_slug'],

		data() {
			return {
				post: {}
			}
        },
        
        methods: {
            ...mapActions(['hideLoader']),

            getPost(){
                http.get('posts/' + this.post_slug)
                .then(({ data }) => {
                    this.post = data
                    this.hideLoader()
                })
            }
        },

        created() {
            this.getPost()
        }
	}
</script>

<style>
.post-content {
    margin: 10px;
}
</style>
