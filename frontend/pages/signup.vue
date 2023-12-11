<script setup>
import { reactive } from "vue";
import useUser from '../composables/user';

const { signUp, errors } = useUser();

const initialState = {
    firstname: '',
    lastname: '',
    email: '',
    password: '',
    confirmPassword: '',
};

const signupErrors = reactive({
    firstname: false,
    lastname: false,
    email: false,
    password: false,
    confirmPassword: false,
});

const errorMessage = reactive({
    firstname: "",
    lastname: "",
    email: "",
    password: "",
    confirmPassword: "",
});

const signupForm = reactive({...initialState});

const signupSubmitHandler = async() => {
    if(signupForm.password === signupForm.confirmPassword){
        errorMessage.password = "";
        signupErrors.password = false;
        await signUp(signupForm).then(()=>{
            if(errors.value === null){
                loginErrors.value = {
                    firstname: false,
                    lastname: false,
                    email: false,
                    password: false,
                    confirmPassword: false,
                }
                navigateTo({ path: "/" });
            }else{
                if(errors.value.firstname!==undefined){
                    signupErrors.firstname = true;
                    errorMessage.firstname = errors.value?.firstname[0];
                }else{
                    signupErrors.firstname = false;
                    errorMessage.firstname = "";
                }
                if(errors.value.lastname!==undefined){
                    signupErrors.lastname = true;
                    errorMessage.lastname = errors.value?.lastname[0];
                }else{
                    signupErrors.lastname = false;
                    errorMessage.lastname = "";
                }
                if(errors.value.email!==undefined){
                    signupErrors.email = true;
                    errorMessage.email = errors.value?.email[0];
                }else{
                    signupErrors.email = false;
                    errorMessage.email = "";
                }
                if(errors.value.password!==undefined){
                    signupErrors.password = true;
                    errorMessage.password = errors.value?.password[0];
                }else{
                    signupErrors.password = false;
                    errorMessage.password = "";
                }
            }
            console.log(signupErrors.firstname);
        });
    }else{
        signupErrors.password = true;
        errorMessage.password = "Password and confirm password does not match";
    }
}

</script>
<template>
<div class="flex justify-around h-screen mt-5">
    <div class="logo flex h-min-full items-center">
       <svg viewBox="0 0 24 24" aria-hidden="true" class="h-[0px] md:h-[300px] content-center r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-18jsvk2 r-rxcuwo r-1777fci r-m327ed r-494qqr"><g><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g></svg>
    </div>
    <div class="form justify-center md:justify-start items-center space-y-4 w-auto">
        <p class="ml-auto mr-auto md:ml-0 md:mr-0 text-6xl font-bold mt-20 mx-4 md:mx-0 w-5/6 sm:w-full">Register Now!</p>
        <p class="ml-auto mr-auto md:ml-0 md:mr-0 text-4xl font-bold mx-4 md:mx-0 w-5/6 sm:w-4/6">Join Today.</p>
        <form class="space-y-5 justify-center" @submit.prevent="signupSubmitHandler">
            <div class="flex space-x-2 mx-5 md:mx-0 w-9/12 md:w-11/12">
                <div class="flex flex-col w-3/6 ml-10 md:ml-0">
                    <input v-model="signupForm.firstname" class="border-gray-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring active:border-sky-600 border rounded-md text-lg text-black px-3 py-2" placeholder="Enter your firstname" type="text"/>
                    <div v-if="signupErrors.firstname!==false" class="flex">
                        <p class="text-xs text-red-700">{{ errorMessage.firstname }}</p>
                    </div>
                </div>
                <div class="flex flex-col w-3/6">
                    <input v-model="signupForm.lastname" class="border-gray-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring active:border-sky-600 border rounded-md text-lg text-black px-3 py-2" placeholder="Enter your lastname" type="text"/>
                    <div v-if="signupErrors.lastname!==false" class="flex">
                        <p class="text-xs text-red-700">{{ errorMessage.lastname }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <input v-model="signupForm.email" class="ml-[60px] md:ml-0 md:mr-0 border-gray-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring active:border-sky-600 border w-8/12 md:w-10/12 rounded-md text-lg text-black px-3 py-2" placeholder="Enter your email" type="email"/>
                <div v-if="signupErrors.email!==false" class="flex">
                    <p class="ml-[60px] md:ml-0 text-xs text-red-700">{{ errorMessage.email }}</p>
                </div>
            </div>
             <div class="flex space-x-2 mx-5 md:mx-0 w-9/12 md:w-11/12">
                <div class="flex flex-col w-3/6 ml-10 md:ml-0">
                    <input v-model="signupForm.password" class="border-gray-400 border rounded-md text-lg text-black px-3 py-2 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring active:border-sky-600" placeholder="Enter your password" type="password"/>
                    <div v-if="signupErrors.password!==false" class="flex flex-col">
                        <p class="text-xs text-red-700">{{ errorMessage.password }}</p>
                    </div>
                </div>
                <div class="flex flex-col w-3/6">
                    <input v-model="signupForm.confirmPassword" class="border-gray-400 border rounded-md text-lg text-black px-3 py-2 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring active:border-sky-600" placeholder="Password confirmation" type="password"/>
                </div>
            </div>
            <div class="flex">
            <button type="submit" class="ml-auto mr-auto md:ml-0 md:mr-0 md:w-5/6 w-9/12 bg-sky-600 hover:bg-sky-700 px-10 py-2 rounded-full text-lg font-bold text-white">Sign Up</button>
            </div>
        </form>
        <div class="terms flex w-4/6 text-sm ml-auto mr-auto md:ml-0 md:mr-0 w-5/6 sm:w-4/6">
            <p>By signing up, you agree to the <a class="text-blue-400">Terms of Service</a> and <a class="text-blue-400">Privacy Policy</a>, including <a class="text-blue-400">Cookie Use.</a></p>
        </div>
        <div class="mt-10 space-y-3 w-full sm:w-5/6">
            <div class="flex">
                <p class="ml-auto mr-auto md:ml-0 md:mr-0 font-semibold text-xl">Already have an account?</p>
            </div>
            <div class="flex"> 
                <NuxtLink to="/" class="ml-auto mr-auto md:ml-0 md:mr-0 border border-gray-400 hover:bg-gray-200 px-10 py-2 rounded-full text-md font-bold text-sky-600">Sign In</NuxtLink>
            </div>
        </div>
    </div>
</div>
</template>
<style>
</style>