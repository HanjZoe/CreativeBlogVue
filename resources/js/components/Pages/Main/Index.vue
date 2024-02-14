<template>

<MainePageHeader :userName = "this.userName"

></MainePageHeader>
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">БЛОГ</h1>
            <section class="featured-posts-section">
                <div v-if="this.posts" class="row mb-4">
                    <div v-for="post in this.posts" class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                        <div class="blog-post-thumbnail-wrapper">
                            <img v-if = "post.url_preview_image" :src="post.url_preview_image" alt="blog post">
                        </div>
                        <p v-if = "post.category" class="blog-post-category">{{post.category.title}}</p>


                        <a v-if = "this.userName" href="" @click.prevent="setLike(post.id)">
                            <span >
                                        {{post.like_count}}
                                    </span>
                            <button class=" border-0 bg-transparent" type="submit">
                               <i :class="post.likes.find(obj => obj.user === this.userName.id) ? 'fas fa-heart' : 'far fa-heart'"></i>


                            </button>
                        </a>
                        <div v-if="!this.userName">
                                            <span class=" border-0 bg-transparent">
                                        {{post.like_count}}

                                    </span>
                            <i class="far fa-heart"></i>
                        </div>
                        <router-link :to="{ name: 'main.post', params: { id: post.id }}" class="nav-link">
                            <h6 class="blog-post-title">{{ post.title }}</h6>
                        </router-link>
                    </div>




                    <a v-if="!this.posts" class="blog-post-permalink">
                        <h5 class="blog-post-title">Нет постов</h5>
                    </a>

                </div>


                <div class="row">
                    <div class="mx-auto" style="margin-top: -100px">
                        <ul class="pagination pagination-sm m-0">
                            <li @click.prevent="this.get(this.currentPage - 1)" v-if="this.currentPage !== 1" class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li v-for="link in this.links" class="page-item">
                                <template v-if="Number(link.label)">
                                <a  @click.prevent="this.get(link.label)" :class="link.active ? 'active' : ''" class="page-link" href="#">
                                    {{link.label}}
                                </a>
                                </template>
                            </li>
                            <li @click.prevent="this.get(this.currentPage + 1)" v-if="this.currentPage !== this.lastPage" class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>

            </section>
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <div class="row blog-post-row">
                            <div v-for="randomPost in this.randomPosts" class="col-md-6 blog-post" data-aos="fade-up">
                                <div class="blog-post-thumbnail-wrapper">
                                    <img :src="randomPost.url_preview_image" alt="blog post">
                                </div>
                                <p v-if ="randomPost.category" class="blog-post-category">{{randomPost.category.title}}</p>
                                <a v-if = "this.userName" href="" @click.prevent="setLike(randomPost.id)">
                            <span>
                                        {{randomPost.like_count}}
                                    </span>
                                    <button class=" border-0 bg-transparent" type="submit">
                                        <i :class="randomPost.likes.find(obj => obj.user === this.userName.id) ? 'fas fa-heart' : 'far fa-heart'"></i>

                                    </button>
                                </a>
                                <div v-if="!this.userName">
                                            <span class=" border-0 bg-transparent">
                                        {{randomPost.like_count}}
                                    </span>
                                    <i class="far fa-heart"></i>
                                </div>
                                <router-link :to="{ name: 'main.post', params: { id: randomPost.id }}" class="blog-post-permalink">
                                    <h6 class="blog-post-title">{{randomPost.title}}</h6>
                                </router-link>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-4 sidebar" data-aos="fade-left">
                    <div class="widget widget-post-list">
                        <h5 class="widget-title">Популярные посты</h5>
                        <ul class="post-list">
                            <li v-for="likedPost in this.likedPosts" class="post">
                                <router-link :to="{ name: 'main.post', params: { id: likedPost.id }}" class="post-permalink media">

                                    <img :src="likedPost.url_preview_image" alt="blog post">
                                    <div class="media-body">
                                        <h6 class="post-title">

                                            {{likedPost.title}}

                                        </h6>

                                        <a v-if = "this.userName" href="" @click.prevent="setLike(likedPost.id)">
                            <span>
                                        {{likedPost.like_count}}

                                    </span>
                                            <button class=" border-0 bg-transparent" type="submit">


                                                <i :class="likedPost.likes.find(obj => obj.user === this.userName.id) ? 'fas fa-heart' : 'far fa-heart'"></i>
                                            </button>
                                        </a>
                                        <div v-if="!this.userName">
                                            <span class=" border-0 bg-transparent">
                                        {{likedPost.like_count}}
                                    </span>
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget-title">Категории</h5>

                        <ul v-if="this.categories">

                            <li v-for ="category in this.categories">
                                <router-link :to="{ name: 'main.category', params: { id: category.id }}" class="widget-title" >{{category.title}}</router-link>
                            </li>

                        </ul>

                        <a v-if="!this.categories">Нет категорий</a>

                    </div>
                </div>
            </div>
        </div>

    </main>



</template>

<script>
import api from "../../../api";
export default {
    name: "Index",
data(){
  return{
      posts: null,
      user: null,
      userName: null,
      userName1: 'categories',
      userRole: null,
      items: [],
      currentPage: 1,
      lastPage: 1,
      pagination: null,
      links: null,
      categories: null,
      randomPosts: null,
      likedPosts: null,
      post_like: null,

  }
},
    mounted() {
        this.getSome()
        this.get()

    },
    methods: {
        get(page = 1) {
            api.post("/api/vue/main/posts",{
                'page': page,
            }).then(data => {

                this.posts = data.data.data
                this.pagination = data.data.meta
                this.links = this.pagination.links
                this.currentPage = data.data.meta.current_page;
                this.lastPage = data.data.meta.last_page;
            }).catch(function (e){
                console.log(e)
            })
        },
        getSome(){
            api.get('/api/vue/main/user').then(data => {
                this.userName = data.data.user
                this.categories = data.data.categories
                this.randomPosts = data.data.randomPosts
                this.likedPosts = data.data.likedPost
                console.log(data.data)
            }).catch(function (e){
                console.log(e)
            })
        },
        setLike(post){
            api.post(`/api/vue/main/${post}/likes`).then(() => {
                this.get()
                this.getSome()
            })

        }
    },

}
</script>

<style scoped>

</style>
