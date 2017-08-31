<template>
	<div v-if="images">
		<div class="carousel-main carousel">
			<div class="carousel-cell" v-for="image in images"><img class="img-responsive" :src="image.img_path"></div>
		</div>
	</div>
</template>

<script>

	export default {
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
			$( document ).ready(function() {
				setTimeout(function() {					
					var flkty = new Flickity('.carousel-main', {
						cellAlign: 'left',
						//freeScroll: true,
						wrapAround: true,
						lazyLoad: true
					});
				}, 2000)
			});
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