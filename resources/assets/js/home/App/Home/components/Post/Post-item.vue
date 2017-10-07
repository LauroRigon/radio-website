<template>
    <div class="row">
        <div class="col m12">
            <div class="card hoverable">
                <div class="card-image">
                    <router-link :to="{name:'post', params: {post_slug: post.slug}}">
                        <img :src="post.thumbnail">
                        <span class="card-title"><h4 class="post-title">{{ post.title }}</h4></span>
                    </router-link>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col m12">
                            <p class="text-faded"><i class="tiny material-icons">dehaze</i>Categoria: {{ post.category_id }} | <i class="tiny material-icons">access_time</i>Publicado em: {{ post.published_at }}</p>
                        </div>
                    </div>
                    <p>
                        {{ post.subtitle }}
                    </p>
                    <div class="row">
                        <div class="col m2 right">
                            <router-link :to="{name:'post', params: {post_slug: post.slug}}">Ler mais...</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { http } from '../../../../services'

	export default {
		data() {
			return {
				post: this.postData,
				error: false
			}
		},

		props:{
			postData: {
				type: Object,
				required: true
			}
		}
	}
</script>

<style>
.post-title {
    text-shadow:0 1px 1px black;
}

.text-faded {
    color: #868e96 !important;
    font-size: 13px;
}
</style>
