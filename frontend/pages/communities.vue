<script setup>
import { onMounted } from "vue";
import useUser from "../composables/user";

const { logOut, getUser, userData } = useUser();


onMounted(()=>{
    if(!localStorage.getItem("token")){
        navigateTo('/');
    }
    getUser();
});
</script>

<template>
<div class="h-screen w-auto flex justify-center items-center bg-gradient-to-r from-indigo-200 from-10% via-sky-200 via-30% to-emerald-200 to-90% ...">
    <div class="card w-6/12 h-6/12">
        <h1 class="font-semibold text-4xl">Welcome to Communities Page {{`${userData.firstname} ${userData.lastname}`}}</h1>
        <button class="px-4 py-2 rounded-md bg-sky-400 hover:bg-sky-300 font-semibold" @click.prevent="logOut">Logout</button>
    </div>
</div>
</template>

<style>
</style>