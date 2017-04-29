<template>
  <vuetable ref="vuetable"
    api-url="users/getUsers"
    :fields="fields"
  ></vuetable>
</template>

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'
import CustomActions from './CustomActions'

Vue.component('custom-actions', CustomActions)

export default {
  components: {
    Vuetable
  },

  data(){
    return {
      fields: [
        'id', 'name', 'email',
        {
          name: 'is_master',
          title: 'Level'
        },
        {
          name: '__component:custom-actions',
          title: 'Ações',
          titleClass: 'text-center',
          dataClass: 'text-center'
        }
      ]
    }
  },

  mounted() {
    console.log (this.data);
  }
}
</script>