<template>
    <button @click="logout">Logout</button>

    <div>All cards</div>
        <div id="cards" v-for="card in paginateCards" :key="card.id">
            <form @submit.prevent="updateCard(card.id)">
                <input v-model="card.number" type="text"/>
                <input v-model="card.PIN" type="text"/> 
                <input v-model="card.activate" type="datetime-local"/>
                <input v-model="card.validity" type="date"/>
                <input v-model="card.balance" type="number"/>
                <button type="submit">Update</button>  
            </form>
            <button @click="deleteCard(card.id)">Delete</button>
        </div>
        <div id="pages">
            <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">Prev</button>
            <button v-for="p in totalPages" :key="p" @click="goToPage(p)" :class="{active: currentPage === p}">{{ p }}</button>
        </div> 
    <form @submit.prevent="createCard">
        <input v-model="number" type="text" placeholder="number" required/>
        <input v-model="PIN" type="text" placeholder="PIN" required/>
        <input v-model="activate" type="datetime-local" placeholder="Activate" required/>
        <input v-model="validity" type="date" placeholder="Validity" required/>
        <input v-model="balance" type="number" placeholder="Balance" required/>
        <button type="submit">Create</button>
    </form>
    <div id="response" v-if="response">{{response}}</div>
</template>
<script setup>
import {computed, ref} from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const response = ref("");
const number = ref("");
const PIN = ref("");
const activate = ref("");
const validity = ref("");
const balance = ref("");
const cards = ref([]);
const currentPage = ref(1);
const page = ref(5);
const totalPages = ref(1);

const logout = async () => {
    try {
        await axios.post("/logout");
        router.push("/login");
    }
    catch(error) {
        console.log(error);
    }
};
const getCards = async () => {
    try{
        const res = await axios.get("/getAllCards");
        cards.value = res.data;
        totalPages.value = Math.ceil(cards.value.length / page.value);
    }
    catch(error) {
        console.log(error);
    }
};
getCards();
const paginateCards = computed(() => {
    const start = (currentPage.value - 1) * page.value;
    const end = start + page.value;
    return cards.value.slice(start, end); 
});
const goToPage = (page) => {
    if(page >= 1 && page <= totalPages.value)
        currentPage.value = page;
};
const createCard = async () => {
    try{
        const res = await axios.post("/createCard", {
            number: number.value,
            PIN: PIN.value,
            activate: activate.value,
            validity: validity.value,
            balance: balance.value,
        });
        response.value = res.data.message;
        getCards(); 
    }
    catch(error) {
        response.value = "Create card error";
        console.log(error);
    }
};
const updateCard = async (id) => {
    const card = cards.value.find(c => c.id === id);
    try{
        const res = await axios.post("/updateCard", {
            id: id,
            number: card.number,
            PIN: card.PIN,
            activate: card.activate,
            validity: card.validity,
            balance: card.balance,
        });
        response.value = res.data.message;
        getCards();
    }
    catch(error) {
        response.value = "Update card error";
        console.log(error); 
    }
};
const deleteCard = async (id) => {
    try{
        const res = await axios.post("/deleteCard", {
            id: id,
        });
        response.value = res.data.message;
        getCards();
    }
    catch(error) {
        response.value = "Delete card error";
        console.log(error);
    }
}
</script>