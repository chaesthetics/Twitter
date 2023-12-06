<script setup>
import { onMounted } from "vue";
import { initFlowbite } from 'flowbite';
import useUser from "../composables/user";

const { logOut, getUser, userData } = useUser();

onMounted(()=>{
    initFlowbite();
    getUser();
});

</script>
<template>
<aside class="sticky h-screen top-0 space-y-1 border border-left-1px flex flex-col justify-between">
    <div class="pt-3">
        <svg viewBox="0 0 24 24" aria-hidden="true" class="pt-3 mr-auto ml-auto md:ml-[53px] h-10 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-lrsllp r-18jsvk2 r-16y2uox r-8kz0gk"><g><path stroke-width="0.3" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g></svg>
        <div class="side-items mt-3 md:ml-10">
            <NuxtLink to="/home" class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#191919" class="bi bi-house-door-fill md:ml-0" viewBox="0 0 16 16" stroke="#191919"> <path stroke-width="0.3" d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/> </svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">Home</span>
            </NuxtLink>
        </div>
        <div class="side-items md:ml-10">
            <NuxtLink to="/explore" class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#191919" class="bi bi-compass md:ml-0" viewBox="0 0 16 16" stroke="#191919"> <path stroke-width="0.3" d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016zm6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/> <path stroke-width="0.3" d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.828-4.95z"/> </svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">Explore</span>
            </NuxtLink>
        </div>
        <div class="side-items md:ml-10">
            <NuxtLink class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#191919" class="bi bi-bell md:ml-0" viewBox="0 0 16 16" stroke="#191919"><path stroke-width="0.3" d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/> </svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">Notifications</span>
            </NuxtLink>
        </div>
        <div class="side-items md:ml-10">
            <NuxtLink to="/message" class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#191919" class="bi bi-envelope" viewBox="0 0 16 16" stroke="#191919"> <path stroke-width="0.3" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/> </svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">Messages</span>
            </NuxtLink>
        </div>
        <div class="side-items md:ml-10">
            <NuxtLink to="/lists" class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#191919" class="bi bi-card-text" viewBox="0 0 16 16" stroke="#191919"> <path stroke-width="0.3" d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/> <path stroke-width="0.3" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/> </svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">Lists</span>
            </NuxtLink>
        </div>
        <div class="side-items md:ml-10">
            <NuxtLink to="/communities" class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="#191919" stroke="currentColor" stroke-width="0.3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path stroke-width="0.3" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path stroke-width="0.3" d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path stroke-width="0.3" d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">Communities</span>
            </NuxtLink>
        </div>
        <div class="side-items md:ml-10">
            <NuxtLink to="/premium" class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-18jsvk2 r-lwhw9o r-cnnz9e"><g><path stroke-width="0.3" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g></svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">Premium</span>
            </NuxtLink>
        </div>
        <div class="side-items md:ml-10">
            <NuxtLink to="/profile" class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                 <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#191919" class="bi bi-person" viewBox="0 0 16 16"> <path stroke-width="0.3" d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/> </svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">Profile</span>
            </NuxtLink>
        </div>
        <div class="side-items md:ml-10">
            <NuxtLink class="py-2.5 px-0 md:px-3 block md:flex flex items-center justify-center md:justify-start w-full md:w-5/6 rounded-full duration-300 cursor-pointer
                hover:bg-gray-300">
                 <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#191919" class="bi bi-three-dots" viewBox="0 0 16 16"> <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg>
                <span class="text-[0px] md:text-[20px] ml-0 md:ml-4 md:font-normal invisible md:visible">More</span>
            </NuxtLink>
        </div>
        <button class="side-items mt-2 ml-auto mr-auto md:mr-0 md:ml-10 flex justify-center md:justify-start bg-sky-500 text-white font-bold py-3.5 px-2.5 w-4/6 rounded-full hover:bg-sky-600 duration-300">
                <h1 class="invisible md:visible md:ml-auto md:mr-auto text-[0px] md:text-[15px]">Tweet</h1>
                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter visible md:invisible" viewBox="0 0 16 16"> <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" fill="white"></path> </svg>
        </button>
    </div>
    <button data-tooltip-target="tooltip-top" data-tooltip-placement="top"  data-tooltip-trigger="click" type="button" class="pr-2 side-items ml-0 md:ml-10 pb-3">
        <div class="text-white font-bold py-2 px-0 justify-center md:px-2.5 ml-1 w-full rounded-full flex md:justify-between items-center hover:bg-gray-300 duration-300">
            <div class="flex space-x-0 md:space-x-2 flex items-center w-12 cursor-pointer">
                <img src="~/assets/images/profile.jpg" class="rounded-full h-[45px] ml-[9px]"/>
                <div class="collapse md:visible">
                    <p class="text-black font-bold leading-4 text-left">{{ userData.firstname }}</p>
                    <p class="leading-4 font-normal text-xs text-gray-600">{{ userData.email }}</p>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="black" class="bi bi-three-dots collapse md:visible" viewBox="0 0 16 16"> <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg>
        </div>
    </button>

    <div id="tooltip-top" role="tooltip" class="absolute z-10 w-[190px] md:w-[300px] invisible inline-block py-2 text-sm font-medium text-black bg-white rounded-xl shadow-[rgba(13,_38,_76,_0.19)_0px_9px_20px] opacity-0 tooltip dark:bg-gray-700">
        <div class="py-2 font-bold text-[16px] text-gray-950 space-y-1">
            <button class="hover:bg-gray-100 py-3 px-3 w-full duration-300">
                <p>Add an existing account</p>
            </button>
            <button @click.prevent="logOut" class="hover:bg-gray-100 py-3 px-3 w-full duration-300">
                <p>Log out {{ userData.firstname }}</p>
            </button>
        </div>
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
</aside>
</template>
<style>
</style>