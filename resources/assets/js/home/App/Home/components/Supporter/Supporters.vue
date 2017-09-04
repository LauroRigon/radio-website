<template>
    <div>
        <template v-for="poll in polls">
            <poll :key="poll.id" :poll-data="poll"></poll>
        </template>
        
    </div>
</template>

<script>
import { http } from '../../../../services'
import Poll from './Supporter'

export default {
    components: { Poll },

    data(){
        return {
            polls: [],
            side: ''
        }
    },

    props: {
        side: {
            type: String,
            required: true,
            validator: (value) => {
                if(value == "right"){
                    return this.side = "right"
                }else{
                    return this.side = "left"
                }
            }
        }
    },

    created() {
        http.get('supporters/getSupportersRight')
        .then( ({ data }) => this.supporters = data)
    }
}
</script>

