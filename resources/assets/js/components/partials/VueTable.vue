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
              <th style="width: 10px" v-for="field in fields">{{field}}</th>
            </tr>
            <div class="overlay" v-show="isLoading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <table-item v-for="(item, index) in tdatas" :key="index" :datas = "item" :has-actions="hasActions">
              <td v-for="singleData in item">{{singleData}}</td>
                
            </table-item>
          </tbody>
          </table>
      </div>
  </div>

</template>

    <script>
      import TableItem from './TableItem.vue'

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
                },
                hasActions: {
                  type: Boolean,
                  default: false
                },
                fields: {
                  type: Array,
                  required: true
                },
                fillable: {
                  type: Array,
                  required: true
                },
                sourceData: {
                  type: String
                }

            },
            data() {
                return {
                    tdatas: [],
                    isLoading: true
                }
            },

            mounted() {
                axios.get(this.sourceData)
                .then(function(serverResponse) {
                  var response = serverResponse.data[0];
                  this.isLoading = false;

                  this.filterUsersData(response);                  
                }.bind(this))
            },

            methods: {
              /*
              * filtra os campos que serão preenchidos baseado na opção fillable. Deletando qualquer dado exedente
              */
              filterUsersData: function(data) {
                this.tdatas = data.filter(function(val) {
                  for (var attName in val){
                    if(this.fillable.indexOf(attName) === -1){
                      delete val[attName];
                    }
                  }
                  return val;
                }.bind(this));
            }
        }
      }
    </script>

    <style>
      .btn {
        margin-top: 5px; 
      }
    </style>

    