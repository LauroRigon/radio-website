<template>

<div class="box">
    <div class="">
      <h5>{{title}}</h5>
    </div>

    <div class="row">
      <div class="col s3 m2 2">
        <slot name="buttons">

        </slot>
      </div>
      <!-- Loader-->
      <div class="col s4">
        <div class="preloader-wrapper small active left" v-show="isLoading">
          <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- /.box-header -->
      <div class="">
        <table class="table highlight">
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
          </thead>
          <tbody>
            <template v-if="items.length > 0">
              <tr v-for="(item, index) in items" :key="index">
                <template v-for="field in fields">
                  <template v-if="isSpecialField(field.name)">
                    <td class="center-align">
                      <div class="">
                        <template v-for="(action, index) in actions">
                          <a :key="index" :class="action.class" @click="callAction(action.action, item)"><i class="material-icons">{{action.icon}}</i></a>
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
      import Pagination from './Pagination.vue'
      import { http } from '../services'

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

              console.log(url)
              http.get(url)
              .then(function(response) {
                console.log(response.data);
                this.items = response.data.data;
                this.pagination = {
                  current_page: response.data.current_page,
                  total_pages: response.data.last_page,
                  per_page: response.data.per_page,
                  total: response.data.total
                };
                this.totalPage = response.data.last_page;
                this.currentPage = response.data.current_page;

                this.isLoading = false;
              }.bind(this))
            },

            callAction(callback, item){
              if(this.hasCallback(callback)) return

                if (typeof callback == 'function') {
                  callback(item);
                }
                return null
            },

            hasCallback(action) {
              return action.callback? true: false;
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

    