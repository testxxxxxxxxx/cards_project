<template>
    <form @submit.prevent="register">
        <input v-model="name" type="text" placeholder="Name" required />
        <input v-model="email" type="email" placeholder="Email" required />
        <input v-model="password" type="password" placeholder="Password" required />
        <input v-model="password_confirmation" type="password" placeholder="Confirm Password" />
        <button type="submit">Register</button>
    </form>
</template>
<script setup>
import {ref} from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const router = useRouter();

const register = async () => {
    try{
        await axios.post("/register", {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });
        router.push("/home");
    }
    catch(error) {
        console.log("error");
    }
};
</script>