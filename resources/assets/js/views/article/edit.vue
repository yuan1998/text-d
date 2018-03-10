<template>
    <div>
        <article-detail :isEdit="true" :id="$route.query.id"></article-detail>
    </div>
</template>

<script>
import articleDetail from './components/article-detail.vue'


export default {
    naem:'createArticle',
    components:{
        articleDetail,
    },
    computed:{
        getId(){
            console.log(this.$route);
            return this.$route.query.id;
        }
    },
    mounted(){
        console.log('edit');
    }
}
</script>
