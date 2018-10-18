<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                 <h2>Hi Samuel</h2>
               <form class="mb-3" @submit.prevent="addarticle">
               <div class="form-group">
                 <input type="text" class="form-control" placeholder="text" v-model="article.title">
               </div>
               <div class="form-group">
                 <textarea class="form-control" placeholder="Body" v-model="article.body"></textarea>
               </div>
               <button type="submit" class="btn btn-primary pull-right">Submit</button>
               </form>

         <nav aria-label="page navigation example">
            <ul class="pagination">
            <li v-bind:class="[{disabled: ! pagination.prev_page_url}]" class="page-item">
            <a  class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a>
            </li>
            <li class="page-item disabled"><a href="#" class="page-link">page{{pagination.current_page}} of {{pagination.last_page}}</a></li>

            <li v-bind:class="[{disabled: ! pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">next</a>
            </li>
            </ul>
        </nav>

               <div v-for = "article in articles" v-bind:key="article.id">
              <h3>{{article.Title}}</h3>
               <p>{{article.Body}}</p>
               <hr>
               <button class="btn btn-danger btn-sm" @click="DeleteArticle(article.id)">Delete</button>
               </div> 
               
        </div>
    </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
            articles:[],
            article:{
                id :'',
                title:'',
                body:''

            },
           article_id:'',
            pagination:{},
            edit:false

        }

    },
    created(){
        this.fetchArticles();

    },
    methods:{
        fetchArticles(page_url){
            page_url = page_url || 'api/articles'
            let vm=this;
            fetch(page_url)
            .then(res =>res.json())
            .then(res =>{
                this.articles= res.data;
                vm.makePagination(res.meta, res.links);

            })
            .catch(err =>console.log(err));
        },
        makePagination(meta, links){
            let pagination={
                current_page: meta.current_page,
                last_page:meta.last_page,
                next_page_url:links.next,
                prev_page_url:links.prev

            }
            this.pagination =pagination; 

        },
        DeleteArticle(id){
            if(confirm('are you sure to delete?')){
                fetch(`api/article1/${id}`, {
                    method:'delete'
                })
                .then(res => res.json())
                .then(data => {
                    alert('article removed');
                    this.fetchArticles();
                })
                .catch(err=>console.log(err));

            }

        },
        addarticle(){
            if(this.edit ===false){
                fetch('api/article',{
                    method:'post',
                    body:JSON.stringify(this.article),
                    header:{
                        'content-type':'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.article.title='';
                    this.article.body= '';
                    alert('article added');
                    this.fetchArticles();
                })
                .catch(err =>console.log(err))

            } else{

            }
        }        

         

    }
}
</script>
