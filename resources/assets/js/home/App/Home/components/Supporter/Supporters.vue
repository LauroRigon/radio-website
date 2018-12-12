<template>
    <div>
        <template v-for="supporter in supporters">
            <supporter :key="supporter.id" :supporter-data="supporter"></supporter>
        </template>
        
    </div>
</template>

<script>
import { http } from '../../../../services'
import Supporter from './Supporter'

export default {
    components: { Supporter },

    data(){
        return {
            supporters: []
        }
    },

    props: {
        side: {
            type: String,
            required: true
        }
    },

    created() {
        http.get('supporters/getSupporters/' + this.side)
        .then( ({ data }) => this.supporters = data)
    }
}
</script>

