//Main do dashboard
import HomeMain from './Home/Domains/Main.vue'

//Parent component
import Parent from './Parent'

import store from '../vuex/'

export default [
    {
        path: '/',
        name: 'home',
        component: HomeMain        
    }    
]