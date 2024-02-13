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
            path: '/admin/users',
            component: AdminUser,
            name: 'admin.user',
        },
        {
            path: '/admin/category',
            component: Category,
            name: 'admin.category',
        },
        {
            path: '/admin/tag',
            component: Tag,
            name: 'admin.tag',
        },
        {
            path: '/admin/post',
            component: PostsIndex,
            name: 'post.index'
        },
        {
            path: '/admin/post/create',
            component: PostCreate,
            name: 'post.create'
        },
        {
            path: '/admin/post/:id/edit',
            component: PostEdit,
            name: 'post.edit'
        },
        {
            path: '/login',
            component: login,
            name: 'user.login',
        },
        {
            path: '/registration',
            component: register,
            name: 'user.registration',
        },
        {
            path: '/personal',
            component: Personal,
            name: 'personal.index'
        },
        {
            path: '/admin',
            component: Admin,
            name: 'admin.index'
        },
        {
            path: '/',
            component: Index,
            name: 'main.index'
        },
        {
            path: '/:id',
            component: Show,
            name: 'main.post'
        },
        {
            path: '/category:id',
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
                path: '/login'
            })
        }
    }
    if (accessToken && to.name === 'user.login' || to.name === 'user.registration') {
        return next({
            path: '/personal'
        })
    }
    next();
})

export default router;
