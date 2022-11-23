<template>
    <div v-if="posts.length > 0">
            <div v-for="post in posts" :key="post.id">
              <span @click="showPost(post.slug)">{{post.title}}</span>
            </div>

           <div class="my-2">
            Total records: {{totalRecords}}
           </div>

            <div class="my-2">

                <button :class="{ disable: currentPage === 1  }" @click="go(paginatedPosts.first_page_url, 1)">First</button>
                <button :class="{ disable: !paginatedPosts.prev_page_url  }" @click="go(paginatedPosts.prev_page_url, currentPage-1)">Indietro</button>
                {{currentPage}}/{{totalPages}}
                <button :class="{ disable: !paginatedPosts.next_page_url  }" @click="go(paginatedPosts.next_page_url, currentPage+1)">Avanti</button>
                <button :class="{ disable: currentPage === totalPages  }" @click="go(paginatedPosts.last_page_url, totalPages)">Last</button>

            </div>

    </div>
    <div v-else>
        Nessun post da visualizzare :(
    </div>
</template>

<script>

export default {
    name: 'PostListPaginatedComponent',
    computed:{
        posts(){
            return this.paginatedPosts.data;
        },
        currentPage(){
            return this.paginatedPosts.current_page;
        },
        totalPages(){
            return this.paginatedPosts.last_page;
        },
        totalRecords(){
            return this.paginatedPosts.total;
        }
    },
    props: {
        paginatedPosts: Object
    },
    methods:{
        showPost(slug){
            this.$emit('clickedPost', slug);
        },
        go(url, pageNumber){

            console.log('url:', url);
            if (url){
                this.$router.push({ path: '/posts', query: { page: pageNumber} })
                this.$emit('requestPage', url)
            }

        }
    }
}
</script>

<style scoped lang="scss">
button.disable{
    opacity: 0.5;
    pointer-events: none;
}
</style>
