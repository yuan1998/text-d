import VueRouter from 'vue-router'
import Store from '../store/index'




const cpt = file => require('../views/'+ file + '.vue' );

let routes = [
	{
		path:'/',
        name:'home',
		component : cpt('layouts/layouts'),
		meta:{
            title:'首页',
        }
	},
    {
        path:'/article',
        name:'文章',
        component : cpt('layouts/layouts'),
        meta:{},
        childrens:[
            {
                path:'/create',
                component : cpt('article/create'),
                name:'createArticle',
                meta:{
                    title:'发布文章'
                }
            },
            {
                path:'edit',
                component : cpt('article/edit'),
                name:'editArticle',
                meta:{
                    title: '修改文章'
                }
            }
        ]
    }
]


const router = new VueRouter({
    mode: 'history',
    saveScrollPosition: true,
    root: '/admin',
    routes
})

export default router;

