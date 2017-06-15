<template>
	<div v-if="images">
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
				images: false
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
					cellAlign: 'left',
					//freeScroll: true,
					wrapAround: true,
					lazyLoad: true
				});
			}, 500)
		},

		methods: {
			loadImgs() {
				axios.get(this.SourceApi)
				.then(function(response) {
					this.images = (response.data[0].length != 0)? response.data[0]: false;
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