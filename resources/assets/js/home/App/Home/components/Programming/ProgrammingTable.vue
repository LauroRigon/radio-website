<template>
<div class="row">
    <div class="col m12">
        <div class="card">
            <div class="col s6 m12">
                <ul class="tabs z-depth-1">
                    <li class="tab col s2"><a href="#" @click.prevent="activeWeek = 'segunda-feira'">SEG</a></li>
                    <li class="tab col s2"><a href="#" @click.prevent="activeWeek = 'terca-feira'">TER</a></li>
                    <li class="tab col s2"><a href="#" @click.prevent="activeWeek = 'quarta-feira'">QUA</a></li>
                    <li class="tab col s2"><a href="#" @click.prevent="activeWeek = 'quinta-feira'">QUI</a></li>
                    <li class="tab col s2"><a href="#" @click.prevent="activeWeek = 'sexta-feira'">SEX</a></li>
                    <li class="tab col s2"><a href="#" @click.prevent="activeWeek = 'sabado'">SAB</a></li>
                    <li class="tab col s2"><a href="#" @click.prevent="activeWeek = 'domingo'">DOM</a></li>
                </ul>

                <table class="bordered">
                    <thead>
                    <tr>
                        <th>Programa</th>
                        <th>Hora</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="program in programming" :key="program.id">
                        <template v-if="program.day_of_week == activeWeek">
                            <td>{{ program.name }}</td>
                            <td>{{ program.time }}</td>
                        </template>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>				
        </div>
    </div>
</div>
</template>

<script>
import { http } from '../../../../services'
import { mapActions } from 'vuex'
export default {
    data() {
        return {
            programming: [],
            activeWeek: 'segunda-feira'
        }
    },

    created() {
        this.getProgramming()
        this.initTabs()
    },

    methods: {
        getProgramming() {
            http.get('programming/')
            .then(({ data }) => {
                this.hideLoader()
                this.programming = data
            })
        },

        initTabs() {
            $(document).ready(function(){
                $('ul.tabs').tabs();
            });
        },
        ...mapActions([
            'hideLoader'
        ]),
    }
}
</script>

<style>
.tabs .tab {
    width: 110px !important;
}

@media screen and (max-width: 600px) {
   .row .col .s6 {
        padding-left: 1px !important; 
        width: 43%;
    }
}

.tabs .tab a{
    color: #322C53 !important;
}
.tabs .indicator{
    background-color: #322C53 !important;
    height: 3px;
}
</style>

