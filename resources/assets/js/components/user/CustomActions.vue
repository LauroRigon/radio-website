  <template>
    <div class="btn-group">
      <button class="btn btn-warning" @click="editAction(rowData, rowIndex)"><i class="glyphicon glyphicon-pencil"></i></button>
      <button class="btn btn-danger" @click="deleteAction(rowData, rowIndex)"><i class="glyphicon glyphicon-trash"></i></button>
    </div>
  </template>

  <script>
  export default {
    props: {
      rowData: {
        type: Object,
        required: true
      },
      rowIndex: {
        type: Number
      }
    },
    methods: {
      editAction (data, index) {
        console.log('custom-actions: ' + data.name, index)
      },
      deleteAction (data, index) {
        console.log('delete-actions: ' + data.name, index)
      }
    }
  }
  </script>
