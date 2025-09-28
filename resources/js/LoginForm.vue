<template>
    <form @submit.prevent="login">
        <input v-model="email" type="email" placeholder="Email" required/>
        <input v-model="password" type="password" placeholder="Password" required/>
        <button type="submit">Login</button>
    </form>
</template>
<script setup>
import {ref} from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const email = ref("");
const password = ref("");
const router = useRouter();

//send to /login
const login = async () => {
    try{
        await axios.post("/login", {
            email: email.value,
            password: password.value,
        });
        router.push("/home");
    } 
    catch(error) {
        console.error("error");   
    }
};
</script>