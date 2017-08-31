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
          <pagination @loadPage="loadPage" :pagination="pagination"></pagination>
      </div>
  </div>

</template>

    <script>
      import Pagination from './Pagination.vue';

      export default {
          components: {
            Pagination
          },
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
                isLoading: false,
                pagination: null,
                totalPage: 0,
                currentPage: 0
              }
          },

          mounted() {
            this.loadData();

            Event.$on('reload-table', function(){
              this.loadData();
            }.bind(this));
          },

          methods: {
            loadPage(page) {
              if (page == 'prev') {
                  this.goPreviousPage();
              } else if (page == 'next') {
                  this.goNextPage();
              } else {
                  this.goToPage(page);
              }
            },

            goPreviousPage() {
              if(this.currentPage > 1){
                this.currentPage--;
                this.loadData();
              }
            },

            goNextPage() {
              if(this.totalPage > this.currentPage){
                this.currentPage++;
                this.loadData();
              }
            },

            goToPage(page) {
              if (page != this.currentPage && (page > 0 && page <= this.totalPage)) {
                    this.currentPage = page;
                    this.loadData();
                }
            },

            loadData(){
              this.isLoading = true;
              var url = this.sourceData;

              if (this.currentPage) {
                  let page = ''
                  if (url.indexOf('?') != -1) {
                      page = '&page='
                  } else {
                      page = '?page='
                  }
                  url = url + page + this.currentPage
              }

              axios.get(url)
              .then(function(response) {
                console.log(response.data);
                this.items = response.data[0].data;
                this.pagination = {
                  current_page: response.data[0].current_page,
                  total_pages: response.data[0].last_page,
                  per_page: response.data[0].per_page,
                  total: response.data[0].total
                };
                this.totalPage = response.data[0].last_page;
                this.currentPage = response.data[0].current_page;

                this.isLoading = false;
              }.bind(this))
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

    