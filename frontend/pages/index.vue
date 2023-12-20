<script setup>
import { onMounted, reactive, ref } from "vue";
import useUser from '../composables/user';
import { useRouter } from "vue-router";

const router = useRouter();

const { logIn, errors, successMessage, errorsMessage } = useUser();

const initialState = {
    email: '',
    password: '',
}

const isError = ref(false);

const toastSuccess = ref(''); 

onMounted(()=>{
   toastSuccess.value = localStorage.getItem("signUp");
   localStorage.removeItem("signUp");
   setTimeout((()=>{
        toastSuccess.value = '';
    }), 8000);
});

const loginErrors = reactive({
    email: false,
    password: false,
});

const errorMessage = reactive({
    email: "",
    password: "",
});
const loginForm = reactive({...initialState});

const loginSubmitHandler = async() => { 
    await logIn(loginForm)
    .then(()=>{
        if(!errors.value){
            loginErrors.value = {
                email: false,
                password: false,
            }
            navigateTo({ path: "/home" });
        }else{
            isError.value = true;
            setTimeout((()=>{
                    isError.value = false;
                }), 5000);
            if(errors.value?.email!==undefined){
                loginErrors.email = true;
                errorMessage.email = errors.value?.email[0];
            }else{
                errorMessage.email = '';
            }
            if(errors.value?.password!==undefined){
                loginErrors.password = true;
                errorMessage.password = errors.value?.password[0];
            }else{
                errorMessage.password = '';
            }
            console.log(errors.value.email[0]);
        }
    });
}
</script>
<template>
<div class="flex justify-around h-screen mt-5">
    <div v-if="isError" class="absolute right-10 top-8 w-60 animate-bounce">
        <div id="toast-warning" class="flex items-center max-w-xs px-7 py-2 text-gray-500 bg-red-100 border-t-4 border-red-500 rounded-md shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div>
            <span class="text-md font-bold text-red-600">Error</span>
            <div class="text-xs text-red-700 font-normal duration-300">{{ errorsMessage }}</div>
        </div>
        <button type="button" class="ms-auto -mx-2.5 -my-1.5 text-red-800 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-red-300 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        </div>
    </div>
    <div v-if="toastSuccess" class="absolute right-10 top-8 w-60 animate-bounce">
        <div id="toast-success" class="flex items-center max-w-xs px-7 py-2 text-gray-500 bg-green-100 border-t-4 border-green-500 rounded-md shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div>
            <span class="text-md font-bold text-green-600">Success</span>
            <div class="text-xs text-green-700 font-normal duration-300">{{ toastSuccess }}</div>
        </div>
        <button type="button" class="ms-auto -mx-2.5 -my-1.5 text-green-800 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-green-300 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        </div>
    </div>
    <div class="logo flex h-min-full items-center">
       <svg viewBox="0 0 24 24" aria-hidden="true" class="h-[0px] md:h-[300px] content-center r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-18jsvk2 r-rxcuwo r-1777fci r-m327ed r-494qqr"><g><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g></svg>
    </div>
    <div class="form justify-center md:justify-start items-center space-y-4 w-auto">
        <p class="ml-auto mr-auto md:ml-0 md:mr-0 text-6xl font-bold mt-20 mx-4 md:mx-0 w-5/6 sm:w-full">Happening Now</p>
        <p class="ml-auto mr-auto md:ml-0 md:mr-0 text-4xl font-bold mx-4 md:mx-0 w-5/6 sm:w-4/6">Join Today.</p>
        <form class="space-y-5 justify-center" @submit.prevent="loginSubmitHandler">
            <div class="flex">         
                <input v-model="loginForm.email" class="ml-auto mr-auto md:ml-0 md:mr-0 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring active:border-sky-600 border-gray-400 border mx-4 md:mx-0 w-5/6 sm:w-4/6 rounded-md text-lg text-black px-3 py-2" placeholder="Enter your email" type="text"/>
            </div>
            <div v-if="loginErrors.email!==false" class="flex">
                <p class="ml-10 mr-10 md:ml-0 md:mr-0 mt-[-18px] text-xs text-red-700">{{ errorMessage.email }}</p>
            </div>
            <div class="flex">
                <input v-model="loginForm.password" class="ml-auto mr-auto md:ml-0 md:mr-0 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring active:border-sky-600 border-gray-400 border mx-4 md:mx-0 w-5/6 sm:w-4/6 rounded-md text-lg px-3 py-2" placeholder="Enter your password" type="password"/>
            </div>
            <div v-if="loginErrors.password!==false" class="flex">
                <p class="ml-10 mr-10 md:ml-0 md:mr-0 mt-[-18px] text-xs text-red-700">{{ errorMessage.password }}</p>
            </div>
            <div class="flex">
                <button type="submit" class="ml-auto mr-auto md:ml-0 md:mr-0 mx-4 md:mx-0 w-5/6 sm:w-4/6 bg-sky-600 hover:bg-sky-700 px-10 py-2 rounded-full text-lg font-bold text-white">Sign In</button>
            </div>
        </form>
        <div class="terms flex w-4/6 text-sm ml-auto mr-auto md:ml-0 md:mr-0 w-5/6 sm:w-4/6">
            <p>By signing up, you agree to the <a class="text-blue-400">Terms of Service</a> and <a class="text-blue-400">Privacy Policy</a>, including <a class="text-blue-400">Cookie Use.</a></p>
        </div>
        <div class="mt-10 space-y-3 w-full sm:w-5/6">
            <div class="flex">
                <p class="ml-auto mr-auto md:ml-0 md:mr-0 font-semibold text-xl">Dont have an account?</p>
            </div>
            <div class="flex">
                <NuxtLink to="/signup" class="ml-auto mr-auto md:ml-0 md:mr-0 border border-gray-400 hover:bg-gray-200 px-10 py-2 rounded-full text-md font-bold text-sky-600">Sign Up</NuxtLink>
            </div>
        </div>
    </div>
</div>
</template>
<style>
</style>