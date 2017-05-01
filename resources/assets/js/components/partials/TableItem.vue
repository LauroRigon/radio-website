<template>
	<transition
    name="item-animate"
    enter-active-class="animated fadeIn"
    leave-active-class="animated bounceOutRight"
  	>
		<tr v-show="isVisible">
	      <td v-for="data in datas">{{data}}</td>
	      
			
	      <td v-if="hasActions">
	        <div class="btn-group">
				<button class="btn btn-info" @click="viewAction(datas)"><i class="glyphicon glyphicon-search"></i></button>
	          	<button class="btn btn-warning" @click="editAction(datas)"><i class="glyphicon glyphicon-pencil"></i></button>
	          	<button class="btn btn-danger" @click="deleteAction(datas)"><i class="glyphicon glyphicon-trash"></i></button>
	        </div>
	      </td>
	    </tr>
    </transition>
</template>

<script>

	export default {
		props: {
			datas: {
				required: true
			},

			hasActions: {
				type: Boolean,
				default: false
			}
		},
		data() {
			return {
				isVisible: true
			}
		},

		methods: {
          editAction: function(data) {
            console.log(data)
          },

          deleteAction: function(data) {
			this.isVisible = false
		  },

		  viewAction: function(data) {
			Event.$emit("open-view-modal", data);
		  }
		}


	}
</script>
