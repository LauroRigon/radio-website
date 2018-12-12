<template>
	<div class="row">
		<div class="col m12">
			<div class="card">
				<div class="card-header z-depth-2">
					{{ this.supporter.name }}
				</div>
				<div class="card-content black-text">
					<a :href="this.supporter.link" rel="noopener" target="_blank">
						<img :src="this.supporter.image" class="responsive-img">
					</a>
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
			supporter: this.supporterData
		}
	},

	props:{
		supporterData: {
			type: Object,
			required: true
		}
	}
}
</script>

<style>
.overlay {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	z-index: 10;
	background-color: rgba(0,0,0,0.2);
}

.card-header {
	color: white;
	background-color: #322C53;
	padding: 15px 0 15px 0;
}

.card-title {
	padding-top:10px!important;
	font-size: 20px !important;
}

.card-content {
	padding: 7px !important;
}

.result-num {
	padding-top: 15px !important;
}
</style>
