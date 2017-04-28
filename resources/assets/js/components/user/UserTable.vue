<template>
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{title}}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          <th style="width: 10px" v-for="thead in theads">{{thead}}</th>
          
        </tr>
        <table-item v-for="user in users" datas="user">
          
              
        </table-item>
        
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
      <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#">&laquo;</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">&raquo;</a></li>
      </ul>
    </div>
  </div>
</template>

    <script>
      import TableItem from './TableItem.vue';
        export default {
            component: {
              TableItem
            },

            props: {
                showPaginate: {
                    type: Boolean,
                    dafault() {
                        return false
                    }
                },
                title: {
                    type: String,
                    default() {
                        return ''
                    }
                }
            },
            data() {
                return {
                    users: {},
                    theads: ['Id', 'Nome', 'Email', 'Master', 'Ação']
                }
            },

            mounted() {
                axios.get('users/getUsers')
                .then(function(serverResponse) {
                  this.users = serverResponse.data[0];

                  this.filterUsersData();
                }.bind(this))
            },

            methods: {
              filterUsersData: function() {
                for(var i = 0; i < this.users.length; i++){
                  console.log(this.users[i]);
                  delete this.users[i].avatar;
                  delete this.users[i].updated_at;
                  delete this.users[i].created_at;
                }
              }    
            }
        }
    </script>

    <style>
      .btn {
        margin-top: 5px; 
      }
    </style>

    