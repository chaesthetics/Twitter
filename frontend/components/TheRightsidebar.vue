<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const toastSuccess = ref("");

// if(router.currentRoute.value.fullPath==="/home"){
//     const isSignIn = localStorage.getItem("signIn") ? localStorage.getItem("signIn") : "";
//     console.log(isSignIn);
// }
</script>
<template>
<aside class="sticky top-0">
     <!-- <div v-if="toastSuccess" class="absolute right-10 top-8 w-60 animate-bounce">
        <div id="toast-success" class="flex items-center max-w-xs px-7 py-2 text-gray-500  border-t-4 border-sky-400 rounded-md shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div>
            <span class="text-md font-bold text-sky-500">Success</span>
            <div class="text-xs text-sky-600 font-normal duration-300">{{ toastMessage }}</div>
        </div>
        <button type="button" class="ms-auto -mx-2.5 -my-1.5 text-sky-800 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-sky-200 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        </div>
    </div> -->
    <div class="flex justify-center items-center h-screen bg-white w-full border border-left-2">
        <h1 class="text-3xl text-neutral-800">Im left side bar</h1>
    </div>
</aside>
</template>
<style></style>