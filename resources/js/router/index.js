
import {createWebHistory, createRouter} from "vue-router";

import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import Home from '../pages/Home';
import Register from '../pages/Register';
import Posts from '../components/Posts';
import EditPost from '../components/EditPost';
import AddPost from '../components/AddPost';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'posts',
        path: '/posts',
        component: Posts
    },
    {
        name: 'addpost',
        path: '/posts/add',
        component: AddPost
    },
    {
        name: 'editpost',
        path: '/posts/edit/:id',
        component: EditPost
    }
  
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});
// configurar todas as rotas
//Fzr importação correta 
//oredm: nome da rota, path cprreto da rota e o componente que será chamado qnd linkar nessa url!
export default router;

