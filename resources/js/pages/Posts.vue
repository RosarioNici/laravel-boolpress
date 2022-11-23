<template>
<div>
    <div v-if="loading">...CARICAMENTO...</div>

    <div v-else-if="errorMessage.length > 0">
        {{errorMessage}}
    </div>

    <PostListPaginatedComponent v-else-if="!detail" :paginatedPosts="posts" @clickedPost="showPost" @requestPage="loadPage" />
    <div  v-else>
        <PostComponent :post="detail" />
        <button @click="showList">BACK</button>
    </div>


</div>
</template>

<script>

import PostComponent from '../components/PostComponent.vue'
import PostListComponent from '../components/PostListComponent.vue'
import PostListPaginatedComponent from '../components/PostListPaginatedComponent.vue'

export default {
    name: 'Posts',
    components:{
        PostComponent,
        PostListComponent,
        PostListPaginatedComponent
    },
    data(){
        return {
            posts: undefined,
            detail: undefined,
            errorMessage: '',
            loading: true
        }
    },
    mounted(){
        console.log('PostComponent exists');
        this.loadPage('/api/posts');
    },
    methods:{
        loadPage(url){
            axios.get(url).then(({data})=>{
                if(data.success){
                    this.posts = data.results;
                    console.log(this.posts)
                }else{
                    this.errorMessage = data.error;
                }
                this.loading = false;
            })
        },
        showPost(id){
            console.log(id);
            this.loading = true;
            axios.get('api/posts/' + id)
                .then(response=>{
                    console.log(response);
                    this.detail = response.data.success ? response.data.results : undefined;
                    this.loading = false;
                })
                .catch(e=>{
                    console.log('errore', e);
                    this.loading = false;
                })
        },
        showList(){
           this.detail = undefined
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
