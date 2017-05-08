<template>
<div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	    <ul class="nav nav-pills nav-stacked">
	      <li v-for="tab in tabs" role="presentation" :class="{'active' : tab.isActive}">
	      	<a href="#" @click="activeTab(tab)">{{tab.name}}</a>
	      </li>
	    </ul>
	</div>
    
    <div class="col-lg-8">
    	<div class="box box-body">
			<slot></slot>
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