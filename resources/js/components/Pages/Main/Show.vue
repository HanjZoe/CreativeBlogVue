<template>
    <MainePageHeader :userName = "this.userName"></MainePageHeader>
    <main v-if="this.post" class="blog-post">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">{{this.post.title}}</h1>
            <p class="edica-blog-post-meta" data-aos="fade-up"
               data-aos-delay="200">{{this.day}}  {{this.mouth}}  {{this.year}}  {{this.time}}
                Коментариев: {{this.post.comments_count }}</p>
            <section class="blog-post-featured-img" data-aos="fade-up" data-aos-delay="300">
                <img :src="this.post.url_main_image" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto" data-aos="fade-up">
                        <p v-html="this.post.content"></p>

                    </div>
                </div>


            </section>
            <section>
                <a v-if="this.userName" @click.prevent="setLike(this.post.id)">
                    <span>
                                    {{this.post.like_count}}
                                </span>
                    <button class=" border-0 bg-transparent" type="submit">


                        <i :class="this.post.likes.find(obj => obj.user === this.userName.id) ? 'fas fa-heart' : 'far fa-heart'"></i>

                    </button>
                </a>
                <span v-if="!this.userName">
                                        {{this.post.like_count}}

                <i class="far fa-heart"></i>
                    </span>
            </section>
            <div v-if="this.relatedPosts.length > 0" class="row">
                <div class="col-lg-9 mx-auto">
                    <section class="related-posts">
                        <h2 class="section-title mb-4" data-aos="fade-up">Рекомендуемые посты</h2>
                        <div class="row">
                            <div v-for="relatedPost in this.relatedPosts" class="col-md-4" data-aos="fade-right" data-aos-delay="100">
                                <router-link :to="{ name: 'main.post', params: { id: relatedPost.id }}">
                                    <img :src="relatedPost.url_main_image" alt="related post"
                                         class="post-thumbnail">
                                    <p class="post-category">{{relatedPost.category.title}}</p>
                                    <h5 class="post-title">{{relatedPost.title}}</h5>
                                </router-link>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <section class="comment-section mx-auto" style="margin-top: 100px">
                <div>
                    <h2 class="section-title mb-5" data-aos="fade-up">Поделись свои мнением
                        ({{this.post.comments_count}})</h2>
                </div>
                <section v-if="this.post.comments_count" class="comment-list mb-5">
                    <div v-if="this.post.comments" class="comment-text mb-3">

                    <span v-for="comment in this.post.comments" class="username">
                        <div>
                      {{comment.user.name}}
                        </div>
                      <span class="text-muted float-right">{{comment.created_at}}</span>
                        {{comment.message}}
                    </span>

                    </div>
                </section>
                <div v-if="!this.post.comments"></div>
                <div v-if="this.userName">
                    <div class="row">
                        <div class="form-group col-12" data-aos="fade-up">
                            <label for="comment" class="sr-only">Комментарий</label>
                            <textarea v-model="this.message" name="message" id="comment" class="form-control"
                                      placeholder="Комментарий"
                                      rows="10">{{this.message}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12" data-aos="fade-up">
                            <button @click.prevent="sentComment()"  class="btn btn-warning" :disabled="!isDisabled">Оставить комментарий</button>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>

</template>

<script>
import api from "../../../api";
export default {
    name: "Show",
    data(){
      return{
          userName: null,
          relatedPosts: null,
          post: null,
          day: null,
          mouth: null,
          time: null,
          year: null,
          message: null,
      }
    },
    mounted() {
        this.get();
    },
    methods:{
            get(){
                api.post(`/api/vue/main/post/${this.$route.params.id}`).then(data => {
                    console.log(data)
                    this.day = data.data.day
                    this.mouth = data.data.mouth
                    this.time = data.data.time
                    this.year = data.data.year
                    this.post = data.data.post
                    this.relatedPosts = data.data.relatedPosts
                    this.userName = data.data.user
                    console.log(this.relatedPosts)
                })
            },
        setLike(post){
            api.post(`/api/vue/main/${post}/likes`).then(() => {
                this.get()
            })

        },
        sentComment(){
                api.post(`api/vue/main/${this.$route.params.id}/comments`, {
                    message: this.message
                }).then(() => {
                    this.get()
                    this.message = null
                })

        },

    },
    computed: {
        isDisabled() {
            console.log('ads')
            return this.message
        }
    },

}
</script>

<style scoped>

</style>
