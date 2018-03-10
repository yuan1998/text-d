<template>
    <div>
        <article-detail :isEdit="false"></article-detail>
    </div>
</template>

<script>
import articleDetail from './components/article-detail.vue'

export default {
    naem:'createArticle',
    components:{
        articleDetail,
    },
    mounted(){
        console.log('create');
    }
}
</script>
