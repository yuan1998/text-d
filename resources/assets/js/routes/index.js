import VueRouter from 'vue-router'
import Store from '../store/index'




const cpt = file => require('../components/'+ file + '.vue' );


console.log(cpt('tinymce/index'));

let routes = [
	{
		path:'',
		component : cpt('tinymce/index'),
		meta:{}
	}
]


const router = new VueRouter({
  mode: 'history',
  routes
})

export default router;

