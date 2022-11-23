<template>
  <div>
       <div v-if="loading">...CARICAMENTO...</div>

        <div v-else-if="errorMessage.length > 0">
            {{errorMessage}}
        </div>
        <PostListPaginatedComponent v-else :paginatedPosts="postPageResult"
        @clickedPost="showPost"
        @requestPage="loadPage" />
  </div>
</template>

<script>
import PostListPaginatedComponent from '../components/PostListPaginatedComponent.vue'

export default {
    name: 'PostsIndex',
    data(){
       return{
            postPageResult: undefined,
            loading: true,
            errorMessage: '',

       }
    },
    mounted(){
        console.log('entro in pagina', this.$route.query.page);
        const page = this.$route.query.page ? this.$route.query.page : 1;
        this.loadPage('/api/posts?page=' + page); // this.$route.query.page || 1);
    },
    methods: {
          loadPage(url){
            console.log(url);

            axios.get(url).then(({data})=>{
                if(data.success){
                    this.postPageResult = data.results;
                    console.log(this.postPageResult)
                }else{
                  //  this.errorMessage = data.error;
                  this.$router.push({name: 'NotFound'});
                }
                this.loading = false;
            }).catch(e =>{
                console.log(e);
            })
        },
        showPost(slug){
            console.log('hai cliccato il post con slug:', slug);
            this.$router.push('/posts/' + slug)
        }
    },

    components: {
        PostListPaginatedComponent
    }
}
</script>

<style>

</style>
