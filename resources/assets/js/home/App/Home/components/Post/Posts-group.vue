<template>
    <div>
        <div class="row">
            <template v-for="post in posts">
                <post :key="post.id" :post-data="post"></post>
            </template>
        </div>
        <div class="row">
            <template v-if="pagination.next_page != null">
                <div class="col m4 offset-m4">
                    <p class="load-button center-align hoverable" @click="loadMorePosts()">Carregar mais</p>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import { http } from '../../../../services'
import Post from './Post-item'
import { mapActions } from 'vuex'


export default {
    components: { Post },

    data(){
        return {
            posts: [],
            pagination: {}
        }
    },

    methods: {
        ...mapActions([
            'hideLoader',
            'showLoader'
        ]),

        loadMorePosts() {
            this.showLoader()
            
            http.get(this.pagination.next_page)
            .then( ({ data }) => {
                this.posts.push(...data.data);
                this.pagination.next_page = data.next_page_url

                this.hideLoader()
            } ); 
        }
    },

    created() {
        http.get('posts/getPosts')
        .then( ({ data }) => {
            this.posts = data.data
            this.pagination.next_page = data.next_page_url

            this.hideLoader()
        })
    }
}
</script>

<style>
.load-button {
    border-radius: 100%;
    font-size: 17px;
    border: 2px solid #322C53;
    color: #322C53;
    padding-top: 50px; 
    width: 130px;
    height: 130px; 
}

.load-button:hover {
    cursor: pointer;
}

</style>
