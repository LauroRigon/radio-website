<template>

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{title}}</h3>
    </div>
    <div class="button-create">
      <template v-for="button in tbButtons">
        <a :class="button.class" @click="executeAction(button)">{{button.text}}</a>
      </template>
    </div>
    <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <template v-for="field in fields">
                <template v-if="isSpecialField(field.name)">
                  <th style="width: 10px" v-if="field.name == '__actions'">Ações</th>
                </template>
                <template v-else>
                  <th style="width: 10px" v-text="field.name"></th>
                </template>
              </template>
            </tr>
            <div class="overlay" v-show="isLoading">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </thead>
          <tbody>
            <template v-if="items.length > 0">
              <tr v-for="item in items">
                <template v-for="field in fields">
                  <template v-if="isSpecialField(field.name)">
                    <td class="text-center">
                      <div class="btn-group">
                        <template v-for="action in actions">
                          <a :class="action.class" @click="(action.name == 'delete-item')? deleteItem(item): executeAction(action, item)"><i :class="action.icon"></i></a>
                        </template>
                      </div>
                    </td>
                  </template>
                  <template v-else>
                    <td v-text="item[field.dbName]"></td>
                  </template>
                </template>
              </tr>
            </template>
          </tbody>
          </table>
      </div>
  </div>

</template>

    <script>
        export default {
            props: {
                title: {
                    type: String,
                    default() {
                        return ''
                    }
                },
                fields: {
                  type: Array,
                  required: true
                },
                sourceData: {
                  type: String
                },
                deleteApi: {
                  type: String
                },
                actions: {
                  type: Array,
                  default(){
                    return []
                  }
                },
                tbButtons: {
                  type: Array,
                  default(){
                    return []
                  }
                }

            },
            data() {
                return {
                    items: [],
                    isLoading: true
                }
            },

            mounted() {
              console.log(window.location.href);
              this.loadData();

              Event.$on('reload-table', function(){
                this.loadData();
              }.bind(this));
            },

            methods: {
              loadData(){
                this.isLoading = true;
                axios.get(this.sourceData)
                .then(function(serverResponse) {
                  this.isLoading = false;

                  this.items = serverResponse.data[0];                  
                }.bind(this))
                .catch(function() {
                  this.isLoading = false;
                  toastr.error("Ocorreu um erro ao tentar buscar os dados!");
                });
              },

              /*executa a action de uma determinada action */
              executeAction(action, item = null) {
                if(action.hasOwnProperty('href')){
                  window.location.href = ('http://' + window.location.host + '/' + action.href + ((action.param)? item.id: ''));  //redireciona para a href a partir do caminho atual

                }else if(action.hasOwnProperty('emit')){
                  Event.$emit(action.emit, item);
                }
              },

              deleteItem(item) {
                /*if(confirm("Tem certeza que deseja deletar esse item?") != 1) {
                  return false;
                }*/
                jConfirm.confirm("Tem certeza de deletar este item?", function(confirmation){
                  if(confirmation){

                    axios.delete(this.deleteApi + item.id)
                    .then(function(response) {
                      this.loadData();
                      toastr.success(response.data['status']);
                    }.bind(this))

                    .catch(function(error){
                      if(error.response.status == 500){
                        toastr.warning("Item tem dependências cadastradas!")
                      }else{
                        toastr.error(error.response.data['status'], "Ocorreu um erro ao deletar!")
                      }
                    });

                  }
                }.bind(this));
              },

              /*Verifica se é um item especial como Actions*/
              isSpecialField(name) {
                return name.slice(0, 2) === '__'
              }
        }
      }
    </script>

    <style>
      td >.btn {
        margin-top: 5px; 
      }
      .button-create{
        margin-left: 10px;
      }
    </style>

    