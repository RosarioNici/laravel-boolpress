<template>
  <div>
    <div v-if="loading">
        ...caricamento...
    </div>
    <div v-else>
     <h2>{{post.title}}</h2>
     <div v-if="post.category">
        {{post.category.name}}
     </div>
     <div>
        <span v-for="tag in post.tags" :key="tag.id">
            {{tag.name}}
        </span>
     </div>
     <p>{{post.content}}</p>
    </div>
    <div>
        <!--<router-link :to="{name:'posts-index'}">Back</router-link>-->
        <button @click="back">{{backUrlLabel}}</button>
    </div>
  </div>
</template>

<script>
export default {
    name: 'PostsShow',
    data(){
        return {
            loading: true,
            post: undefined,
            backUrl: '',
            backUrlLabel: ''
        }
    },
    mounted(){
        const slug = this.$route.params.slug;

        this.loadPage('api/posts/' + slug);

    },
    beforeRouteEnter(to, from, next) {
        console.log(to, from);

        next(vueComponent=>{
            console.log(vueComponent);
            vueComponent.backUrl = from.name? from.fullPath: '/posts';
            vueComponent.backUrlLabel = from.name? 'BACK': 'BLOG';



        });
    },
    /*
    beforeRouteLeave (to, from, next) {

        const answer = window.confirm('Do you really want to leave?')
        if (answer) {
            next()
        } else {
            try{
                next(false)
            }catch(e){
                console.log('errore di navigazione');
            }

        }

    },
    */
    methods:{
         loadPage(url){
            console.log(url);

            axios.get(url).then(({data})=>{
                if(data.success){
                    console.log('data', data)
                    this.post = data.results;
                    console.log(this.post)
                }else{
                  //  this.errorMessage = data.error;
                  this.$router.push({name: 'NotFound'});
                }
                this.loading = false;
            }).catch(e =>{
                console.log(e);
            })
        },
        back(){

           // this.$router.go(-1); // ritorna indietro nella history della webapp
           console.log('backUrl',this.backUrl)
           this.$router.push(this.backUrl);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
