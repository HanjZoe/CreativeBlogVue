<template>
<MainePageHeader></MainePageHeader>
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">БЛОГ</h1>
            <section class="featured-posts-section">
                <div class="row mb-4">

                    <div class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                        <div class="blog-post-thumbnail-wrapper">

                        </div>

                            <span>

                                    </span>
                            <button class=" border-0 bg-transparent" type="submit">

                            </button>


                        <div>
                                            <span class=" border-0 bg-transparent">

                                    </span>
                            <i class="far fa-heart"></i>
                        </div>

                    </div>

                    <a class="blog-post-permalink">
                        <h5 class="blog-post-title">Нет постов</h5>
                    </a>

                </div>
                <div class="row">
                    <div class="mx-auto" style="margin-top: -100px">

                    </div>
                </div>

            </section>
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <div class="row blog-post-row">

                            <div class="col-md-6 blog-post" data-aos="fade-up">
                                <div class="blog-post-thumbnail-wrapper">

                                </div>



                                    <span>

                                    </span>
                                    <button class=" border-0 bg-transparent" type="submit">

                                    </button>


                                <div>
                                            <span class=" border-0 bg-transparent">

                                    </span>
                                    <i class="far fa-heart"></i>
                                </div>

                            </div>

                        </div>
                    </section>
                </div>
                <div class="col-md-4 sidebar" data-aos="fade-left">
                    <div class="widget widget-post-list">
                        <h5 class="widget-title">Популярные посты</h5>
                        <ul class="post-list">

                            <li class="post">

                                    <div class="media-body">



                                        <div>
                                            <span class=" border-0 bg-transparent">

                                    </span>
                                            <i class="far fa-heart"></i>
                                        </div>

                                    </div>

                            </li>

                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget-title">Категории</h5>

                        <ul>

                        </ul>

                        <a>Нет категорий</a>

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

    methods: {
        get() {
            api.get("/api/vue/main/posts").then(data => {
                console.log(data)
            })
        }
    },
    mounted() {
        console.log('lol')
        this.get()
    }
}
</script>

<style scoped>

</style>
