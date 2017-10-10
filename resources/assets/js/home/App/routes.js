//Main do dashboard
import HomeMain from './Home/Views/Main.vue'

//Parent component
import Parent from './Parent'

export default [
    {
        path: '/',
        component: HomeMain,
        children: [
            {
                path: '/',
                name: 'home',
                component: require('./Home/Views/Home/Home.vue')
            },
            {
                path: 'programacao',
                name: 'programming',
                component: require('./Home/Views/Programming/Main.vue')
            },
            {
                path: 'locutores',
                name: 'speakers',
                component: require('./Home/Views/Speakers/Main.vue')
            },
            {
                path: 'sobre',
                name: 'about',
                component: require('./Home/Views/About/Main.vue')
            },
            {
                path: 'noticias/',
                component: Parent,
                children: [
                    {
                        path: ':post_slug',
                        name: 'post',
                        props: true,
                        component: require('./Home/components/Post/Post')
                    },
                    {
                        path: '/',
                        name: 'posts',
                        component: require('./Home/Views/Posts/Main.vue')
                    }
                ]
            }
        ]
    }
]