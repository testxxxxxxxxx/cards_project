import {createRouter, createWebHistory} from "vue-router";
import Main from "./Main.vue";
import LoginForm from "./LoginForm.vue";
import RegisterForm from "./RegisterForm.vue";
import HomeForm from "./HomeForm.vue";

const routes = [

    {
        path: "/",
        name: "Main",
        component: Main,
    },
    {
        path: "/login",
        name: "LoginForm",
        component: LoginForm,
    },
    {
        path: "/register",
        name: "RegisterForm",
        component: RegisterForm,
    },
    {
        path: "/home",
        name: "HomeForm",
        component: HomeForm,
        meta: {requiresAuth: true},
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;