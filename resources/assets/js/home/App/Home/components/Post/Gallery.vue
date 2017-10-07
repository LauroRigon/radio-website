<template>
    <div class="row">
        <div class="col m12">
            <div class="carousel carousel-slider" data-indicators="true">
                <template v-for="img in postGallery">
                    <a class="carousel-item" href="#one!" :key="img.id">
                        <img :src="img.img_path"> <!-- random image -->
                    </a>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import { http } from '../../../../services'

	export default {
        props: {
			postGallery: {
				required: true
			}
		},

		data() {
			return {
				
			}
        },
        
        methods: {
            init() {
                $(document).ready(function(){
                    $('.carousel').carousel();
                });
            }
        },

        created() {
            this.init()
        }
	}
</script>


