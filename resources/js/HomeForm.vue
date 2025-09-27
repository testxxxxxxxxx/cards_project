<template>
    <button @click="logout">Logout</button>

    <button @click="show">Show all Cards</button>
    <button @click="create">Create Card</button>
    <from @submit.prevent="create">
        
    </from>
</template>
<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

const logout = async () => {
    try {
        await axios.post("/logout");
        router.push("/login");
    }
    catch(error) {
        console.log(error);
    }
};
const show = async () => {
    try{
        await axios.get("/getAllCards");
        router.push("/getAllCards");
    }
    catch(error) {
        console.log(error);
    }
};
const create = async () => {
    
};
</script>