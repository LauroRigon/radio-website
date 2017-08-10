<template>
<div>    
    <div :class="sizeClass" v-show="isReady">
    	<div class="nav-tabs-custom">
	    	<ul class="nav nav-tabs">
		      <li v-for="tab in tabs" :class="{'active' : tab.isActive}">
		      	<a href="" @click.prevent="activeTab(tab)">{{tab.name}}</a>
		      </li>
		    </ul>
	    	<div class="box box-body">
				<slot></slot>
	    	</div>
    	</div>
    </div>
</div>
</template>

<script>
export default {
	props: {
		sizeClass: {
			type: String,
			default() {
				return 'col-md-8';
			}
		}
	},

	data() {
	    return {
	      tabs: [],
				isReady: false
	    }
	},


	created(){
		this.tabs = this.$children;
	},

	mounted() {
		this.isReady = true;
	},


	methods: {
	activeTab: function(clickedTab) {
	  this.tabs.forEach(function(tab) {
	    tab.isActive = tab.name == clickedTab.name;
	  })
	}
	}
}

</script>

<style>
	

</style>