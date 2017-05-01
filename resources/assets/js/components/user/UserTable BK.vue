<template>
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{title}}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th style="width: 10px" v-for="thead in theads">{{thead}}</th>
          </tr>

          <table-item v-for="(item, index) in tdatas" :key="index" :datas = "item" hasActions="true">
            <td v-for="singleData in item">{{singleData}}</td>
              
          </table-item>
        </tbody>
        </table>
    </div>
  </div>
</template>

    <script>
      import TableItem from '../partials/TableItem.vue'

        export default {
            components: { TableItem },
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
                    tdatas: {},
                    theads: ['Id', 'Nome', 'Email', 'Master', 'Ação']
                }
            },

            mounted() {
                axios.get('users/getUsers')
                .then(function(serverResponse) {
                  this.tdatas = serverResponse.data[0];

                  this.filterUsersData();
                }.bind(this))
            },

            methods: {
              filterUsersData: function() {
                for(var i = 0; i < this.tdatas.length; i++){
                  delete this.tdatas[i].avatar;
                  delete this.tdatas[i].updated_at;
                  delete this.tdatas[i].created_at;
                  this.tdatas[i].is_master = (this.tdatas[i].is_master == 1)? "Sim" : "Não";
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

    