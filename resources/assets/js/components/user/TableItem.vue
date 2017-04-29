<template>
	<tr v-show="isVisible">
      <td v-for="data in datas">{{data}}</td>
      
		
      <td>
        <div class="btn-group">
          <button class="btn btn-warning" @click="editAction(datas)"><i class="glyphicon glyphicon-pencil"></i></button>
          <button class="btn btn-danger" @click="deleteAction(datas)"><i class="glyphicon glyphicon-trash"></i></button>
        </div>
      </td>
    </tr>
</template>

<script>

	export default {
		props: ['datas'],
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
		  }
		}


	}
</script>
