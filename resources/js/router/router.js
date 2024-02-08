import AdminUser from '../components/Pages/Admin/Users/AdminUserIndex';
import Category from "../components/Pages/Admin/Category/Category";
import Tag from "../components/Pages/Admin/Tags/Tags";
import PostsIndex from "../components/Pages/Admin/Posts/PostsIndex";
import PostCreate from "../components/Pages/Admin/Posts/PostCreate"
import PostEdit from "../components/Pages/Admin/Posts/PostEdit";


// import AdminMain from "@/views/SinglePostPage"
import {createRouter, createWebHistory} from "vue-router";


const routes = [
    {
        path: '/vue/admin/users',
        component: AdminUser,
        name: 'admin.user',
    },
    {
        path: '/vue/admin/category',
        component: Category,
        name: 'admin.category',
    },
    {
        path: '/vue/admin/tag',
        component: Tag,
        name: 'admin.tag',
    },
    {
        path: '/vue/admin/post',
        component: PostsIndex,
        name: 'post.index'
    },
    {
        path: '/vue/admin/post/create',
        component: PostCreate,
        name: 'post.create'
    },
    {
        path: '/vue/admin/post/:id/edit',
        component: PostEdit,
        name: 'post.edit'
    },
]

const  router = createRouter({
    history:createWebHistory(),
    routes,
});

export default router;
