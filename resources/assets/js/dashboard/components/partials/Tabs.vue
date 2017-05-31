<template>
<div>    
    <div class="col-lg-8">
    	<div class="nav-tabs-custom">
	    	<ul class="nav nav-tabs">
		      <li v-for="tab in tabs" :class="{'active' : tab.isActive}">
		      	<a href="#" @click="activeTab(tab)">{{tab.name}}</a>
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
	data() {
	    return {
	      tabs: []
	    }
	},


	created: function (){
		this.tabs = this.$children;
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