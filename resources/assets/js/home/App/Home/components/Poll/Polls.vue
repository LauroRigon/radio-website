<template>
    <div>
        <template v-for="poll in polls">
            <poll :key="poll.id" :poll-data="poll"></poll>
        </template>
        
    </div>
</template>

<script>
import { http } from '../../../../services'
import Poll from './Poll'

export default {
    components: { Poll },

    data(){
        return {
            polls: []
        }
    },

    created() {
        http.get('polls/getPolls')
        .then( ({ data }) => this.polls = data)
    }
}
</script>

