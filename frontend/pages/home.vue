<script setup>
import { onMounted, reactive } from "vue";
import useUser from "../composables/user";
import usePost from "../composables/posts"
import moment from "moment"
import { initFlowbite } from 'flowbite';

const { logOut, getUser, userData } = useUser();
const { post, errors, getAllPost, tweets, likepost, unlikepost } = usePost();

const logInToastSuccess = ref("");

defineProps({
    dark:{
        type: Boolean
    }
}); 

onMounted(()=>{
    if(!localStorage.getItem("token")){
        navigateTo('/');
    }
    getUser(userData.value);
    getAllPost();
    logInToastSuccess.value = localStorage.getItem("signIn") ? localStorage.getItem("signIn") : "";
    localStorage.removeItem("signIn");
    setTimeout((()=>{
        logInToastSuccess.value = "";
    }), 3000);
    console.log(tweets);
});

const initialState = {
    'text': '',
    'image': '',
}

const postForm = reactive({...initialState});

const handlePost = async() => {
    const userToken = localStorage.getItem("token");
    await post(userData.value.id, userToken, postForm).then(()=>{
        getAllPost();
        Object.assign(postForm, initialState);
    });
}

const convertToBase64 = async (file) => {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = () => resolve(reader.result);
    reader.onrror = (error) => reject(error);
    reader.readAsDataURL(file);
  });
};

const tweetFileHandler = async(event) => {
    const selectedFile = event.target.files[0];
    // console.log("image upload:", selectedFile);
    if(selectedFile){
        try{
            const base64Tweet = await convertToBase64(selectedFile);
            postForm.image = base64Tweet;
        }catch(err){
            console.log(err);
        }
    }
}

const activePost = ref("");
const activeLike = ref("");

const setActivePost = (postId) => {
    activePost.value = postId;
    console.log("activePost", postId);
} 

const setActiveLike = (postId) => {
    activeLike.value = postId;
} 

const removeActivePost = () => {
    activePost.value = "";
}

const removeActiveLike = () => {
    activeLike.value = "";
}

const handleLike = (postId) => {
    likepost(userData.value.id, postId)
    .then(()=>{
        getUser(userData.value);
    });
}

const handleUnlike = (postId) => {
    unlikepost(userData.value.id, postId).then(()=>{
         getUser(userData.value);
    })
}

</script>

<template>
<div :class="`${dark? 'divide-gray-600': ''} divide-y-[1px]`">
    <div v-if="logInToastSuccess!==''" class="absolute left-10 top-10 space-x-1 animate-bounce bg-sky-50 z-10">
        <div id="toast-success" class="flex items-center max-w-xs px-7 py-2 text-gray-500  border-t-4 border-sky-400 rounded-md shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div>
            <span class="text-md font-bold text-sky-500 text-sky-800">Success</span>
            <div class="text-xs text-sky-600 font-normal duration-300">{{ logInToastSuccess }}</div>
        </div>
        <button type="button" class="ms-auto -mx-2.5 -my-1.5 text-sky-800 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-sky-200 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        </div>
    </div>
<div :class="`${dark ? 'bg-gray-900': 'bg-white'} ${dark ? 'opacity-100': 'opacity-80'} ${dark? 'border-b-[1px] border-gray-600': ''} navbar flex space-x-4 items-center sticky top-0 backdrop-blur-sm z-20`">
    <div class="flex justify-around w-full font-semibold text-center hover:cursor-pointer">
        <div :class="`relative w-full py-4 ${dark ? 'hover:bg-gray-800': 'hover:bg-gray-200'} duration-300 flex-col h-full`">
            <p :class="`${dark ? 'text-white': 'text-black'} h-full mb-auto`">For you</p>
            <div class="absolute inset-x-0 bottom-0 end-0 content-end self-end mt-auto w-3/12 h-1 rounded bg-sky-500 mr-auto ml-auto"></div>
        </div>
        <p :class="`w-full text-gray-600 py-4 ${dark ? 'hover:bg-gray-800': 'hover:bg-gray-200'} ${dark ? 'text-white': 'text-black'} duration-300`">Following</p>
    </div>
    <div class="p-2">
        <div :class="`w-10 h-10 py-0 rounded-full ${ dark ? 'hover:bg-gray-800' : 'hover:bg-gray-300'} hover:cursor-pointer flex items-center justify-center duration-300`">
            <svg viewBox="0 0 24 24" width="19" height="19" :fill="`${ dark ? '#FFFFFF' : '#191919' }`" aria-hidden="true" class=" r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(15, 20, 25);"><g><path d="M10.54 1.75h2.92l1.57 2.36c.11.17.32.25.53.21l2.53-.59 2.17 2.17-.58 2.54c-.05.2.04.41.21.53l2.36 1.57v2.92l-2.36 1.57c-.17.12-.26.33-.21.53l.58 2.54-2.17 2.17-2.53-.59c-.21-.04-.42.04-.53.21l-1.57 2.36h-2.92l-1.58-2.36c-.11-.17-.32-.25-.52-.21l-2.54.59-2.17-2.17.58-2.54c.05-.2-.03-.41-.21-.53l-2.35-1.57v-2.92L4.1 8.97c.18-.12.26-.33.21-.53L3.73 5.9 5.9 3.73l2.54.59c.2.04.41-.04.52-.21l1.58-2.36zm1.07 2l-.98 1.47C10.05 6.08 9 6.5 7.99 6.27l-1.46-.34-.6.6.33 1.46c.24 1.01-.18 2.07-1.05 2.64l-1.46.98v.78l1.46.98c.87.57 1.29 1.63 1.05 2.64l-.33 1.46.6.6 1.46-.34c1.01-.23 2.06.19 2.64 1.05l.98 1.47h.78l.97-1.47c.58-.86 1.63-1.28 2.65-1.05l1.45.34.61-.6-.34-1.46c-.23-1.01.18-2.07 1.05-2.64l1.47-.98v-.78l-1.47-.98c-.87-.57-1.28-1.63-1.05-2.64l.34-1.46-.61-.6-1.45.34c-1.02.23-2.07-.19-2.65-1.05l-.97-1.47h-.78zM12 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5c.82 0 1.5-.67 1.5-1.5s-.68-1.5-1.5-1.5zM8.5 12c0-1.93 1.56-3.5 3.5-3.5 1.93 0 3.5 1.57 3.5 3.5s-1.57 3.5-3.5 3.5c-1.94 0-3.5-1.57-3.5-3.5z"></path></g></svg>
        </div>
    </div>
</div>
<div :class="`card flex px-4 py-3 mt-[-1px] ${dark ? 'bg-gray-900': 'bg-white'}`">
    <div v-if="!userData.avatar" class="flex items-center justify-center h-[42px] w-[42px] md:w-[46px] bg-stone-700 rounded-full">
        <p class="text-white font-bold mb-[1px] text-sm">{{ `${userData.firstname?.split("")[0]}${userData.lastname?.split("")[0]}`}}</p>
    </div>
    <img v-else :src="userData.avatar" class="rounded-full h-[42px] w-[42px] object-cover"/>
    <div class="pl-3 w-5/6 md:w-full">
        <form class="">
            <div>
                <div class="content pt-2">
                    <textarea v-model="postForm.text" rows="1" placeholder="What's on your mind?!" :class="`${ dark ? 'bg-gray-900' : 'bg-white' } ${ dark ? 'text-white' : 'text-gray-900' } outline text-gray-700 text-lg outline-none w-full overflow-hidden resize-none h-auto outline-none border-none focus:outline-none focus:ring-0 focus:ring-offset-0`"></textarea>
                </div>
                <img :src="postForm.image"/>
                <button :class="`${ dark ? 'hover:bg-sky-950' : 'hover:bg-sky-100'} mt-2 flex ml-[-10px] space-x-1 px-2 py-1  w-auto rounded-full duration-300 transition-300`"> 
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1d4mawv r-10ptun7 r-1janqcz" style="rgb(16 169 233)"><g><path fill="rgb(2 132 199)" d="M12 1.75C6.34 1.75 1.75 6.34 1.75 12S6.34 22.25 12 22.25 22.25 17.66 22.25 12 17.66 1.75 12 1.75zm-.25 10.48L10.5 17.5l-2-1.5v-3.5L7.5 9 5.03 7.59c1.42-2.24 3.89-3.75 6.72-3.84L11 6l-2 .5L8.5 9l5 1.5-1.75 1.73zM17 14v-3l-1.5-3 2.88-1.23c1.17 1.42 1.87 3.24 1.87 5.23 0 1.3-.3 2.52-.83 3.61L17 14z"></path></g></svg>
                    <p class="font-bold text-sm text-sky-500">Everyone can reply</p>
                </button>
                <hr :class="`${dark ? 'opacity-30' : 'opacity-100'} mt-2`"/>
            </div>
            <div class="interactions pt-2">
                <div class="common flex justify-between w-full items-center">
                    <div class="flex space-x-3">
                        <div :class="`hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center ${ dark ? 'hover:bg-sky-950' : 'hover:bg-sky-100' } duration-300 transition-300`">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M3 5.5C3 4.119 4.119 3 5.5 3h13C19.881 3 21 4.119 21 5.5v13c0 1.381-1.119 2.5-2.5 2.5h-13C4.119 21 3 19.881 3 18.5v-13zM5.5 5c-.276 0-.5.224-.5.5v9.086l3-3 3 3 5-5 3 3V5.5c0-.276-.224-.5-.5-.5h-13zM19 15.414l-3-3-5 5-3-3-3 3V18.5c0 .276.224.5.5.5h13c.276 0 .5-.224.5-.5v-3.086zM9.75 7C8.784 7 8 7.784 8 8.75s.784 1.75 1.75 1.75 1.75-.784 1.75-1.75S10.716 7 9.75 7z"></path></g></svg>
                            <input type="file" class="absolute w-[20px] opacity-0 hover:cursor-pointer" @change="tweetFileHandler">
                        </div>
                        <div :class="`${ dark ? 'hover:bg-sky-950' : 'hover:bg-sky-100'} hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center duration-300 transition-300`">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M3 5.5C3 4.119 4.12 3 5.5 3h13C19.88 3 21 4.119 21 5.5v13c0 1.381-1.12 2.5-2.5 2.5h-13C4.12 21 3 19.881 3 18.5v-13zM5.5 5c-.28 0-.5.224-.5.5v13c0 .276.22.5.5.5h13c.28 0 .5-.224.5-.5v-13c0-.276-.22-.5-.5-.5h-13zM18 10.711V9.25h-3.74v5.5h1.44v-1.719h1.7V11.57h-1.7v-.859H18zM11.79 9.25h1.44v5.5h-1.44v-5.5zm-3.07 1.375c.34 0 .77.172 1.02.43l1.03-.86c-.51-.601-1.28-.945-2.05-.945C7.19 9.25 6 10.453 6 12s1.19 2.75 2.72 2.75c.85 0 1.54-.344 2.05-.945v-2.149H8.38v1.032H9.4v.515c-.17.086-.42.172-.68.172-.76 0-1.36-.602-1.36-1.375 0-.688.6-1.375 1.36-1.375z"></path></g></svg>
                        </div>
                        <div :class="`${ dark ? 'hover:bg-sky-950' : 'hover:bg-sky-100'} hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center duration-300 transition-300`">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M6 5c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zM2 7c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12V6h10v2zM6 15c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zm-4 2c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12v-2h10v2zM7 7c0 .552-.45 1-1 1s-1-.448-1-1 .45-1 1-1 1 .448 1 1z"></path></g></svg>
                        </div>
                        <div :class="`${ dark ? 'hover:bg-sky-950' : 'hover:bg-sky-100'} hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center duration-300 transition-300`">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M8 9.5C8 8.119 8.672 7 9.5 7S11 8.119 11 9.5 10.328 12 9.5 12 8 10.881 8 9.5zm6.5 2.5c.828 0 1.5-1.119 1.5-2.5S15.328 7 14.5 7 13 8.119 13 9.5s.672 2.5 1.5 2.5zM12 16c-2.224 0-3.021-2.227-3.051-2.316l-1.897.633c.05.15 1.271 3.684 4.949 3.684s4.898-3.533 4.949-3.684l-1.896-.638c-.033.095-.83 2.322-3.053 2.322zm10.25-4.001c0 5.652-4.598 10.25-10.25 10.25S1.75 17.652 1.75 12 6.348 1.75 12 1.75 22.25 6.348 22.25 12zm-2 0c0-4.549-3.701-8.25-8.25-8.25S3.75 7.451 3.75 12s3.701 8.25 8.25 8.25 8.25-3.701 8.25-8.25z"></path></g></svg>
                        </div>
                        <div :class="`${ dark ? 'hover:bg-sky-950' : 'hover:bg-sky-100'} hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center duration-300 transition-300`">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M6 3V2h2v1h6V2h2v1h1.5C18.88 3 20 4.119 20 5.5v2h-2v-2c0-.276-.22-.5-.5-.5H16v1h-2V5H8v1H6V5H4.5c-.28 0-.5.224-.5.5v12c0 .276.22.5.5.5h3v2h-3C3.12 20 2 18.881 2 17.5v-12C2 4.119 3.12 3 4.5 3H6zm9.5 8c-2.49 0-4.5 2.015-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.015 4.5-4.5-2.01-4.5-4.5-4.5zM9 15.5C9 11.91 11.91 9 15.5 9s6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5S9 19.09 9 15.5zm5.5-2.5h2v2.086l1.71 1.707-1.42 1.414-2.29-2.293V13z"></path></g></svg>
                        </div>
                        <div :class="`${ dark ? 'hover:bg-sky-950' : 'hover:bg-sky-100'} hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center duration-300 transition-300`">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M12 7c-1.93 0-3.5 1.57-3.5 3.5S10.07 14 12 14s3.5-1.57 3.5-3.5S13.93 7 12 7zm0 5c-.827 0-1.5-.673-1.5-1.5S11.173 9 12 9s1.5.673 1.5 1.5S12.827 12 12 12zm0-10c-4.687 0-8.5 3.813-8.5 8.5 0 5.967 7.621 11.116 7.945 11.332l.555.37.555-.37c.324-.216 7.945-5.365 7.945-11.332C20.5 5.813 16.687 2 12 2zm0 17.77c-1.665-1.241-6.5-5.196-6.5-9.27C5.5 6.916 8.416 4 12 4s6.5 2.916 6.5 6.5c0 4.073-4.835 8.028-6.5 9.27z"></path></g></svg>
                        </div>
                    </div>
                    <div class="rare flex space-x-3 items-center">
                        <button :class="`${ dark ? 'bg-sky-600' : 'bg-sky-500'} ${ dark ? 'hover:bg-sky-700' : 'hover:bg-sky-600'} text-white font-bold px-5 py-2 rounded-full `" type="submit" @click.prevent="handlePost">Tweet</button>
                    </div>
                </div>
            </div> 
        </form>
    </div>
</div>    

<div v-for="(tweet, index) in tweets" :key="index" :class="`${ dark ? 'bg-gray-900' : 'bg-white' } ${ dark ? 'hover:bg-gray-800' : 'hover:bg-gray-100' } hover:cursor-pointer card flex px-4 py-5 duration-200 transition-200`">
    <div v-if="!tweet.user.avatar" class="flex items-center justify-center h-[42px] w-[48px] md:w-[46px] mt-1 bg-stone-700 rounded-full">
        <p :class="`text-white font-bold mb-[1px] text-sm`">{{ `${tweet.user.firstname.split("")[0]}${tweet.user.lastname.split("")[0]}`}}</p>
    </div>
    <img v-else :src="tweet.user.avatar" class="rounded-full w-[42px] h-[42px] md:w-[42px] md:h-[42px] object-cover"/>
    <div class="pl-3 w-full">
        <div class="flex justify-between w-full">
            <div class="userinfo flex space-x-1">   
                <div class="flex space-x-1 items-center">
                    <NuxtLink @mouseleave="removeActivePost" @mouseover="setActivePost(tweet.id)" :to="`/profile/${tweet.user.email.split('@')[0]}`" :class="`${ dark ? 'text-white' : 'text-black'} font-semibold hover:underline`">{{ tweet.user.firstname }}</NuxtLink>                    
                    <div :id="`popover-user-profile${tweet.id}`" :class="`${tweet.id === activePost ? 'visible' : 'invisible'} absolute z-10 mt-[230px] left-[70px] md:left-[280px] inline-block w-[300px] text-sm text-gray-500 transition-opacity opacity-100 duration-300 transition-300 rounded-xl shadow-xl`">
                        <div :class="`${dark? 'bg-gray-900':'bg-white'} p-3 rounded-lg border ${dark?'border-gray-700':''}`">
                            <div class="flex items-center justify-between mb-2">
                                <a href="#">
                                    <img class="w-16 h-16 rounded-full object-cover" :src="tweet.user.avatar" :alt="tweet.user.firstname">
                                </a>
                                <div>
                                    <button type="button" :class="`${dark? 'text-gray-900 bg-white hover:bg-gray-200 font-bold':'text-white bg-neutral-900 hover:bg-neutral-800 font-medium'} focus:ring-4 focus:ring-blue-300 rounded-full text-md px-4 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800`">Follow</button>
                                </div>
                            </div>
                            <p :class="`${dark?'text-gray-200':'text-gray-900'} text-base font-bold leading-none dark:text-white`">
                                <a href="#">{{tweet.user.firstname+' '+tweet.user.lastname}}</a>
                            </p>
                            <p :class="`${dark?'text-gray-300':'text-gray-900'} mb-3 text-md font-normal`">
                                <a href="#" class="hover:underline">@{{tweet.user.firstname}}</a>
                            </p>
                            <p class="mb-4 text-sm">Default Bio <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">username.com</a>.</p>
                            <ul class="flex text-sm space-x-3">
                                <li class="me-2">
                                    <a href="#" class="hover:underline space-x-1">
                                        <span :class="`${dark ? 'text-gray-300':'text-gray-900'} font-semibold dark:text-white`">11</span>
                                        <span :class="`${dark ? 'text-gray-300':'text-gray-900'}`">Following</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="hover:underline space-x-1">
                                        <span :class="`${dark ? 'text-gray-300':'text-gray-900'} font-semibold dark:text-white`">379.4K</span>
                                        <span :class="`${dark ? 'text-gray-300':'text-gray-900'}`">Followers</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>                    
                    <img class="h-5 w-5 mt-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
                </div>
                <p :class="`${ dark ? 'text-gray-300' : 'text-gray-500' } font-light items-center flex`">@{{ tweet.user.email.split("@")[0] }}</p>
                <p :class="`${ dark ? 'text-gray-300' : 'text-gray-500' } font-light text-gray-500 items-center flex invisible text-[0px] md:text-[16px] md:visible`"> · {{ moment(tweet.created_at)?.fromNow() }}</p> 
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" :fill="`${dark?'white':'black'}`" class="bi bi-three-dots" viewBox="0 0 16 16"> <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg>
            </div>
        </div>
        <div class="content w-full space-y-2 pb-2 mt-2">
            <p :class="`${ dark ? 'text-white':'text-black' }`">{{ tweet.text }}</p>
            <img :src="tweet.image" class="w-full object-fill rounded-xl"/>
        </div>
        <div class="interactions pt-4">
            <div class="common flex justify-between w-full overflow-y-visible">
                <div class="flex items-center space-x-2">
                    <svg v-if="tweet.like?.some((user)=> user.user_id === userData.id)" @click.prevent="handleUnlike(tweet.id)" style="color: red" xmlns="http://www.w3.org/2000/svg" class="w-5" viewBox="0 0 512 512"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" fill="red"></path></svg>
                    <svg v-else @click.prevent="handleLike(tweet.id)" xmlns="http://www.w3.org/2000/svg" width="18" height="18" :fill="`${dark?'white':'black'}`" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                    <p  v-if="tweet.like.length > 0"  type="button" :class="`text-sm ${dark?'text-white':'text-black'} font-bold`" @mouseleave="removeActiveLike" @mouseover="setActiveLike(tweet.id)">{{tweet.like.length}}</p>
                </div>
                   <div :id="`likes-tooltip-${tweet.id}`" :class="`${activeLike==tweet.id ? 'visible' : 'invisible'} absolute z-10 px-3 py-2 ml-2 mt-6 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-100 dark:bg-gray-700`">
                        <b>Likes</b>
                        <p v-for="(size, index) in tweet.like.slice().reverse()" :key="index">
                            {{`${size.user.firstname} ${size.user.lastname}`}}
                        </p>
                    </div>
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" :fill="`${dark?'white':'black'}`" class="bi bi-chat" viewBox="0 0 16 16"> <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/> </svg>
                    <p :class="`text-sm ${dark?'text-white':'text-black'}`"></p>
                </div>
                <div class="flex items-center space-x-2">
                    <svg viewBox="0 0 24 24" aria-hidden="true" width="18" height="18" :fill="`${dark?'white':'black'}`" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1xvli5t r-1hdv0qi"><g><path d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg>
                    <p :class="`text-sm ${dark?'text-white':'text-black'}`"></p>
                </div>
         
                <div class="flex items-center space-x-2">
                    <svg viewBox="0 0 24 24" aria-hidden="true" width="18" height="18" :fill="`${dark?'white':'black'}`"  class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1xvli5t r-1hdv0qi"><g><path d="M8.75 21V3h2v18h-2zM18 21V8.5h2V21h-2zM4 21l.004-10h2L6 21H4zm9.248 0v-7h2v7h-2z"></path></g></svg>
                    <p :class="`text-sm ${dark?'text-white':'text-black'}`"></p>
                </div>
                <div class="rare flex space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" :fill="`${dark?'white':'black'}`" class="bi bi-bookmark" viewBox="0 0 16 16"> <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/> </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" :fill="`${dark?'white':'black'}`" class="bi bi-box-arrow-up" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/> <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/> </svg>
                </div>
            </div>
        </div> 
    </div>
</div>    
</div>
</template>
<style>
input[type='file']{
    cursor: pointer;
}
</style>