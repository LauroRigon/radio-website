<template>
	
</template>

<script>
	export default{
		props: {
			trigger: {
				required: true
			}
		},

		data(){
			return {
				data: {}
			}
		},
		mounted() {
			Event.$on(this.trigger, function(data){
				this.data = data;
				$emit('trigged');
			});
		},

		methods: {
			redirectToEdit: function($path) {
				alert('wat');
			}
		}
	}
</script>