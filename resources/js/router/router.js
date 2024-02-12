import AdminUser from '../components/Pages/Admin/Users/AdminUserIndex';
import Category from "../components/Pages/Admin/Category/Category";
import Tag from "../components/Pages/Admin/Tags/Tags";
import PostsIndex from "../components/Pages/Admin/Posts/PostsIndex";
import PostCreate from "../components/Pages/Admin/Posts/PostCreate"
import PostEdit from "../components/Pages/Admin/Posts/PostEdit";
import login from "../components/Pages/Main/login";
import register from "../components/Pages/Main/register";
import Personal from "../components/Pages/Personal/Personal";
import Admin from "../components/Pages/Admin/Admin";
import Index from "../components/Pages/Main/Index";
import Show from "../components/Pages/Main/Show";
import CategoryPage from "../components/Pages/Main/Category";

// import AdminMain from "@/views/SinglePostPage"

import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(),

    routes: [
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
        {
            path: '/vue/login',
            component: login,
            name: 'user.login',
        },
        {
            path: '/vue/registration',
            component: register,
            name: 'user.registration',
        },
        {
            path: '/vue/personal',
            component: Personal,
            name: 'personal.index'
        },
        {
            path: '/vue/admin',
            component: Admin,
            name: 'admin.index'
        },
        {
            path: '/vue',
            component: Index,
            name: 'main.index'
        },
        {
            path: '/vue/:id',
            component: Show,
            name: 'main.post'
        },
        {
            path: '/vue/category:id',
            component: CategoryPage,
            name: 'main.category'
        },
        {
            path: '/:catchAll(.*)',
            component: login,
            name: 'notfoud'
        }
    ]
})

router.beforeEach((to, from, next) => {
    const accessToken = localStorage.getItem('access_token')

    if (!accessToken) {
        if (to.name === 'user.login' || to.name === 'user.registration' || to.name === 'main.index' || to.name === 'main.post' || to.name === 'main.category') {
            return next()
        } else {
            return next({
                path: '/vue/login'
            })
        }
    }
    if (accessToken && to.name === 'user.login' || to.name === 'user.registration') {
        return next({
            path: '/vue/personal'
        })
    }
    next();
})

export default router;
