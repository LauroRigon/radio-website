<template>
	<div>
		<div class="main-carousel carousel">
			<div class="carousel-cell" v-for="image in images"><img class="img-responsive" :src="image.img_path"></div>

		</div>

		<img-slider> </img-slider>
	</div>
</template>

<script>
	import ImgSlider from './Slider.vue'

	export default {
		components: { ImgSlider },

		props: {
			SourceApi: {
                    type: String,
                    default() {
                        return ''
                    }
                }
		},

		data() {
			return {
				images: {}
			}
		},

		created() {
			this.loadImgs();
		},

		mounted() {
			var self = this;
			setTimeout(function() {
				var el = document.querySelector('.carousel');
				
				var flkty = new Flickity(el, {
					cellAlign: 'center',
					contain: true,
					imagesLoaded: true,
  					percentPosition: false
				});
			}, 500)
		},

		methods: {
			loadImgs() {
				axios.get(this.SourceApi)
				.then(function(response) {
					this.images = response.data[0];
				}.bind(this));
			}
		}
	}
</script>

<style>
	.carousel {
		height: 600px;
	}

	.carousel-cell {
	  height: 100%;
	  width: 105%;
	}
</style>