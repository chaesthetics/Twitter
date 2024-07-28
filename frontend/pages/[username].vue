<script setup>
import { useRoute } from "vue-router";
import { onMounted, reactive } from "vue";
import useUser from "../composables/user";
import { initFlowbite } from 'flowbite';
import moment from 'moment';
import usePost from "../composables/posts";

const { logOut, getUser, userData, updateProfile, fetchUserTweets, userTweets } = useUser();
const { update, deletepost, likepost, unlikepost } = usePost(); 

const user = ref({
    firstname: "",
    lastname: "",
    email: "",
    bio: "",
    avatar: "",
    cover: "",
});

const router = useRoute();

const updatePostForm = ref({
    text: "",
    image: "",
}); 

const userTweet = ref({}); 

const updateToastSuccess = ref("");

onMounted(async()=>{
    if(!localStorage.getItem("token")){
        navigateTo('/');
    }
    initFlowbite();
    await getUser().then(()=>{
        console.log(router.path.replace("/", ""));
        user.value.firstname = userData.value.firstname;
        user.value.lastname = userData.value.lastname;
        user.value.email = userData.value.email;
        user.value.bio = userData.value.bio;
        user.value.avatar = userData.value.avatar;
        user.value.cover = userData.value.cover;
    }).then(()=>{
           fetchUserTweets(userData.value.id).then(()=>{
                userTweet.value = userTweets.value;
                userTweet.value.reverse();
           });
    }); 
});

const convertToBase64 = async (file) => {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = () => resolve(reader.result);
    reader.onrror = (error) => reject(error);
    reader.readAsDataURL(file);
  });
};

const profilePicHandler = async(event) => {
    const selectedProfile = event.target.files[0];
    // console.log(selectedProfile); 
    if(selectedProfile){
        try{
            const base64Profile = await convertToBase64(selectedProfile);
            userData.value.avatar = base64Profile;
            // console.log(userData.avatar); 
        }catch(err){
            console.error("Error in converting image to base64", err);
        }
    }
}

const coverPicHandler = async(event) => {
    const selectedCover = event.target.files[0];
    // console.log(selectedProfile); 
    if(selectedCover){
        try{
            const base64Cover = await convertToBase64(selectedCover);
            userData.value.cover = base64Cover;
        }catch(err){
            console.error("Error in converting image to base64", err);
        }
    }
}

const deleteSuccess = ref("");

const handleDeletePost = async(postId) => {
    await deletepost(postId);
    fetchUserTweets(userData.value.id).then(()=>{
        userTweet.value = userTweets.value;
        userTweet.value.reverse();
    }).then(()=>{
        deleteSuccess.value = JSON.parse(localStorage.getItem("deleteSuccess"));
        isActiveMenu.value = "";
        isActivePost.value = "";
        setTimeout((()=>{
            deleteSuccess.value = "";
        }), 4000);
        localStorage.removeItem("deleteSuccess");
    });
}

const saveClickHandler = async(userId) => {
    await updateProfile(userId).then(()=>{
        document.getElementById('closeModal').click();
        updateToastSuccess.value = JSON.parse(localStorage.getItem("updateProfileSuccess"));
        localStorage.removeItem("updateProfileSuccess");
        user.value.firstname = userData.value.firstname;
        user.value.lastname = userData.value.lastname;
        user.value.email = userData.value.email;
        user.value.bio = userData.value.bio;
        user.value.avatar = userData.value.avatar;
        user.value.cover = userData.value.cover;
    }).then(()=>{
        setTimeout((()=>{
            updateToastSuccess.value = "";
        }), 6000);
    });  
}

const isActiveMenu = ref("");

const activeMenu = (event) => {
    event.target.id == isActiveMenu.value ? isActiveMenu.value = "" : isActiveMenu.value = event.target.id;
    console.log(isActiveMenu.value);
}

const isActivePost = ref("");

const updatePost = (id) => {
    isActivePost.value = id;
}

const removeActivePost = () => {
    isAddedPic.value = false;
    addedPic.value = "";
    isActivePost.value = "";
    isPostImageRemoved.value = false;
}

const isPostImageRemoved = ref(false);

const imageRemover = () => {
    isPostImageRemoved.value = true;
}

const updatePostHandler = async(postId, text, image) => {
    updatePostForm.value.text = text;
    updatePostForm.value.image = image;
    if(isPostImageRemoved.value===true){
        updatePostForm.value.image = "";
    }
    if(addedPic.value!==""){
        updatePostForm.value.image = addedPic.value;
    }
    await update(postId, updatePostForm.value);
    fetchUserTweets(userData.value.id).then(()=>{
            userTweet.value = userTweets.value;
            userTweet.value.reverse();
        }).then(()=>{
            updateToastSuccess.value = JSON.parse(localStorage.getItem("updatePostSuccess"));
            isAddedPic.value = false;
            addedPic.value = "";
            isActivePost.value = "";
            isPostImageRemoved.value = false;
            isActiveMenu.value = "";
            localStorage.removeItem("updatePostSuccess");
            setTimeout((()=>{
                updateToastSuccess.value = "";
            }), 6000);
    })
}

const isAddedPic = ref(false);
const addedPic = ref("");

const handleImagePostChange = async(event) => {
    isAddedPic.value = true;
    const newPic = event.target.files[0];
    if(newPic){
        try{
            const base64Pic = await convertToBase64(newPic);
            addedPic.value = base64Pic;
        }catch(err){
            console.error("Error in converting image to base64", err);
        }
    }
}

const isAddedRemover = () => {
    isAddedPic.value = false;
    addedPic.value = "";
}

const activeLike = ref("");

const setActiveLike = (postId) => {
    activeLike.value = postId;
} 

const removeActiveLike = () => {
    activeLike.value = "";
}

const handleLike = (postId) => {
    likepost(userData.value.id, postId).then(()=>{
        fetchUserTweets(userData.value.id).then(()=>{
                userTweet.value = userTweets.value;
                userTweet.value.reverse();
        });
    })
}

const handleUnlike = (postId) => {
    unlikepost(userData.value.id, postId).then(()=>{
        fetchUserTweets(userData.value.id).then(()=>{
                userTweet.value = userTweets.value;
                userTweet.value.reverse();
        });
    })
}

</script>
<template>
<div>
    <div v-if="deleteSuccess" class="absolute left-10 top-10 space-x-1 animate-bounce bg-red-50 z-50">
        <div id="toast-success" class="flex items-center max-w-xs px-7 py-2 text-gray-500  border-t-4 border-red-400 rounded-md shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div>
            <span class="text-md font-bold text-red-500 text-red-800">Success</span>
            <div class="text-xs text-red-600 font-normal duration-300">{{ deleteSuccess }}</div>
        </div>
        <button type="button" class="ms-auto -mx-2.5 -my-1.5 text-red-800 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        </div>
    </div>
     <div v-if="updateToastSuccess" class="absolute left-10 top-10 space-x-1 animate-bounce bg-green-50 z-50">
        <div id="toast-success" class="flex items-center max-w-xs px-7 py-2 text-gray-500  border-t-4 border-green-400 rounded-md shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div>
            <span class="text-md font-bold text-green-500 text-green-800">Success</span>
            <div class="text-xs text-green-600 font-normal duration-300">{{ updateToastSuccess }}</div>
        </div>
        <button type="button" class="ms-auto -mx-2.5 -my-1.5 text-green-800 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
        </div>
    </div>
    <div class="navbar flex space-x-4 items-center sticky top-0 backdrop-blur-sm bg-white bg-opacity-80 z-20">
        <div class="p-2">
            <NuxtLink to="/home" class="w-10 h-10 py-0 z-20 rounded-full hover:bg-gray-300 flex items-center justify-center duration-300">
              <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(15, 20, 25);"><g><path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z"></path></g></svg>
            </NuxtLink>
        </div>
        <div class="flex flex-col justify-between">
            <div class="flex space-x-1 items-center">
                <p class="font-bold text-xl">{{ user.firstname }}</p>
                <img class="h-5 w-5" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
            </div>
            <p class="text-xs text-gray-700">7,011 tweets</p>
        </div>
    </div>
<div class="profile">
        <div class="cover w-full hover:cursor-pointer">
            <div v-if="!user.cover" class="h-[140px] md:h-[200px] w-full bg-sky-400"></div>
            <img v-else :src="user.cover" class="max-h-[140px] md:max-h-[200px] w-full object-cover"/>
        </div>
        <div class="information py-2 px-5">
            <div class="grid grid-cols-7">
                <div class="col-span-2 profilepic h-5 hover:cursor-pointer w-full">
                    <div v-if="!user.avatar" 
                        class="w-28 h-28 md:w-36 md:h-36 bg-stone-700 rounded-full flex border border-white border-t-[4px] border-l-[3px] border-r-[3px] items-center -mt-16 md:-mt-[86px] justify-center">
                        <p class="text-white mb-2 md:mb-3 font-bold text-3xl md:text-5xl">{{ `${userData.firstname?.split("")[0] ? userData.firstname?.split("")[0] : "" }${userData.lastname?.split("")[0] ? userData.lastname?.split("")[0] : ""}`}}</p>
                    </div>
                    <img v-else :src="user.avatar" 
                    class="rounded-full border border-white border-t-[4px] border-l-[3px] border-r-[3px] object-cover h-[106px] w-[110px] md:h-[140px]  md:w-[140px] -mt-16 md:-mt-[86px] object-contain"/>
                </div>
                <div class="flex space-x-2 col-span-5 justify-end">
                    <!-- <button class="w-9 h-9 py-0 rounded-full hover:bg-gray-300 border border-gray-200 flex items-center justify-center duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16"> <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg>
                    </button>    
                    <button class="w-9 h-9 py-0 rounded-full hover:bg-gray-300 border border-gray-200 flex items-center justify-center duration-300">
                       <svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(15, 20, 25);"><g><path d="M1.998 5.5c0-1.381 1.119-2.5 2.5-2.5h15c1.381 0 2.5 1.119 2.5 2.5v13c0 1.381-1.119 2.5-2.5 2.5h-15c-1.381 0-2.5-1.119-2.5-2.5v-13zm2.5-.5c-.276 0-.5.224-.5.5v2.764l8 3.638 8-3.636V5.5c0-.276-.224-.5-.5-.5h-15zm15.5 5.463l-8 3.636-8-3.638V18.5c0 .276.224.5.5.5h15c.276 0 .5-.224.5-.5v-8.037z"></path></g></svg>
                    </button>   
                    <button class="h-9 follow px-4 rounded-full font-semibold bg-neutral-900 hover:bg-neutral-800 text-white flex items-center">
                        Follow
                    </button>    -->
                    <button class="border text-[15px] border-1 px-4 py-[5.5px] hover:bg-gray-200 duration-300 transition-300 animation-300  rounded-full font-bold"
                       id="closeModal" data-modal-target="edit-profile-modal" data-modal-toggle="edit-profile-modal" type="button">Edit Profile</button>
                </div> 
            </div>

                        <!-- Main modal -->
            <div id="edit-profile-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-x-hidden fixed top-0 right-0 left-0 z-40 justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-screen">
                <div class="relative w-full h-screen bg-black bg-opacity-40">
                    <!-- Modal content -->
                    <form>
                    <div class="relative ml-auto mr-auto md:mt-[36px] bg-white h-screen overflow-y-scroll md:h-[600px] md:rounded-xl shadow dark:bg-gray-700 w-12/12 h-screen md:w-5/12">
                        <!-- Modal header -->
                        <div class="sticky top-0 backdrop-blur-sm bg-white bg-opacity-80 z-50 flex items-center justify-between p-2 md:p-3 rounded-t dark:border-gray-600">
                            <div class="flex items-center space-x-2">
                            <button data-modal-hide="edit-profile-modal" class="w-10 h-10 py-0 z-20 rounded-full hover:bg-gray-300 flex items-center justify-center duration-300" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>
                            </button>
                            <p class="text-lg font-bold text-gray-900">Edit Profile</p>
                            </div>
                            <button @click.prevent="saveClickHandler(userData.id)" class="bg-gray-900 hover:bg-gray-800 px-4 rounded-full py-[5.5px] text-white text-sm font-bold" type="submit">Save</button>
                        </div>
                        <!-- Modal body -->
                        <div class="space-y-4 md:h-[520px]">
                            <div class="relative">
                                <div class="relative px-[2px]">
                                    <!-- <img src="~/assets/images/default.png" class="brightness-50"/> -->
                                    <div v-if="!userData.cover" class="h-[162px] md:h-[183px] bg-sky-400 w-full brightness-50">
                                        <div class="absolute h-full w-full ">
                                            <div class="flex space-x-4 items-center justify-center h-full">
                                                <div class="relative group">
                                                    <button class="w-12 h-12 py-0 z-20 rounded-full bg-black bg-opacity-80 cursor-pointer group-hover:bg-opacity-60 flex items-center justify-center duration-300">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" fill="white" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-18yzcnr r-yc9v9c" style="color: rgb(255, 255, 255);"><g><path d="M9.697 3H11v2h-.697l-3 2H5c-.276 0-.5.224-.5.5v11c0 .276.224.5.5.5h14c.276 0 .5-.224.5-.5V10h2v8.5c0 1.381-1.119 2.5-2.5 2.5H5c-1.381 0-2.5-1.119-2.5-2.5v-11C2.5 6.119 3.619 5 5 5h1.697l3-2zM12 10.5c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2zm-4 2c0-2.209 1.791-4 4-4s4 1.791 4 4-1.791 4-4 4-4-1.791-4-4zM17 2c0 1.657-1.343 3-3 3v1c1.657 0 3 1.343 3 3h1c0-1.657 1.343-3 3-3V5c-1.657 0-3-1.343-3-3h-1z"></path></g></svg>
                                                    </button>
                                                    <input @change="coverPicHandler" class="absolute top-0 h-[50px] text-5xl left-0 w-12 opacity-0 cursor-pointer" type="file"/>
                                                </div>
                                                <button class="cursor-default w-12 h-12 py-0 z-20 rounded-full bg-black bg-opacity-80 hover:bg-opacity-60 flex items-center justify-center duration-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else class="relative w-full brightness-50">
                                        <img :src="userData.cover" class="max-h-[162px] md:max-h-[183px] object-cover w-full"/>
                                        <div class="absolute  top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                            <div class="flex space-x-4">
                                                <div class="relative group">
                                                    <button class="w-12 h-12 py-0 z-20 rounded-full bg-black bg-opacity-80 cursor-pointer group-hover:bg-opacity-60 flex items-center justify-center duration-300">
                                                        <svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" fill="white" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-18yzcnr r-yc9v9c" style="color: rgb(255, 255, 255);"><g><path d="M9.697 3H11v2h-.697l-3 2H5c-.276 0-.5.224-.5.5v11c0 .276.224.5.5.5h14c.276 0 .5-.224.5-.5V10h2v8.5c0 1.381-1.119 2.5-2.5 2.5H5c-1.381 0-2.5-1.119-2.5-2.5v-11C2.5 6.119 3.619 5 5 5h1.697l3-2zM12 10.5c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2zm-4 2c0-2.209 1.791-4 4-4s4 1.791 4 4-1.791 4-4 4-4-1.791-4-4zM17 2c0 1.657-1.343 3-3 3v1c1.657 0 3 1.343 3 3h1c0-1.657 1.343-3 3-3V5c-1.657 0-3-1.343-3-3h-1z"></path></g></svg>
                                                    </button>
                                                    <input @change="coverPicHandler" class="absolute top-0 h-[50px] text-5xl left-0 w-12 opacity-0 cursor-pointer" type="file"/>
                                                </div>
                                                <button class="cursor-default w-12 h-12 py-0 z-20 rounded-full bg-black bg-opacity-80 hover:bg-opacity-60 flex items-center justify-center duration-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                             <div class="relative profilepic h-5 ml-[10px] z-20 group">
                                <div v-if="!userData.avatar" class="absolute brightness-50 z-20 items-center w-28 h-28 md:w-32 md:h-32 bg-stone-700 rounded-full flex border border-white border-t-[4px] border-l-[3px] border-r-[3px] items-center -mt-16 md:-mt-[70px]">
                                        <p class="text-white mb-2 md:mb-2 font-bold text-3xl ml-auto mr-auto md:text-4xl">{{ `${userData.firstname?.split("")[0] ? userData.firstname?.split("")[0] : ""}${userData.lastname?.split("")[0] ? userData.lastname?.split("")[0] : ""}` }}</p>
                                </div>
                                <img v-else :src="userData.avatar" class="absolute brightness-50 z-20 items-center w-28 h-28 md:w-32 md:h-32 rounded-full object-cover flex border border-white border-t-[4px] border-l-[3px] border-r-[3px] items-center -mt-16 md:-mt-[70px]"/>
                                <button class="absolute top-[-27px] md:top-[-25px] left-[32px] md:left-[40px] w-12 h-12 py-0 z-20 group-hover:bg-opacity-60 rounded-full bg-black bg-opacity-80 cursor-pointer group-hover:bg-opacity-60 flex items-center justify-center duration-300">
                                    <svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" fill="white" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-18yzcnr r-yc9v9c" style="color: rgb(255, 255, 255);"><g><path d="M9.697 3H11v2h-.697l-3 2H5c-.276 0-.5.224-.5.5v11c0 .276.224.5.5.5h14c.276 0 .5-.224.5-.5V10h2v8.5c0 1.381-1.119 2.5-2.5 2.5H5c-1.381 0-2.5-1.119-2.5-2.5v-11C2.5 6.119 3.619 5 5 5h1.697l3-2zM12 10.5c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2zm-4 2c0-2.209 1.791-4 4-4s4 1.791 4 4-1.791 4-4 4-4-1.791-4-4zM17 2c0 1.657-1.343 3-3 3v1c1.657 0 3 1.343 3 3h1c0-1.657 1.343-3 3-3V5c-1.657 0-3-1.343-3-3h-1z"></path></g></svg>
                                </button>
                                <input @change="profilePicHandler" class="absolute opacity-0 h-[50px] text-3xl top-[-22px] md:top-[-22px] left-[35px] md:left-[45px] w-10 z-40" type="file"/>
                            </div>
                            <div class="flex w-full flex-col justify-center items-center space-y-4 mt-10 md:mt-14 pb-5 md:pb-8">
                                <div class="w-11/12 relative">
                                    <input v-model="userData.firstname" type="text" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-md border-[1px] border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-sky-500 focus:outline-none focus:ring-0 focus:border-sky-300 peer" placeholder=" " />
                                    <label for="floating_outlined" class="absolute text-md text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-sky-600 peer-focus:dark:text-sky-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Firstname</label>
                                </div>
                                <div class="w-11/12 relative">
                                    <input v-model="userData.lastname" type="text" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-md border-[1px] border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-sky-500 focus:outline-none focus:ring-0 focus:border-sky-300 peer" placeholder=" " />
                                    <label for="floating_outlined" class="absolute text-md text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-sky-600 peer-focus:dark:text-sky-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Lastname</label>
                                </div>
                                <div class="w-11/12 relative">
                                    <textarea v-model="userData.bio" id="message" rows="3" class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-md border-[1px] border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-sky-500 focus:outline-none focus:ring-0 focus:border-sky-300 peer"></textarea>
                                    <label for="floating_outlined" class="absolute text-md text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-sky-600 peer-focus:dark:text-sky-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Biography</label>
                                </div>
                                <div class="w-11/12 relative">
                                    <input v-model="userData.email" type="email" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-md border-[1px] border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-sky-500 focus:outline-none focus:ring-0 focus:border-sky-300 peer" placeholder=" " />
                                    <label for="floating_outlined" class="absolute text-md text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-sky-600 peer-focus:dark:text-sky-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Email</label>
                                </div>
                                <div class="w-11/12 relative">
                                    <input type="text" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-md border-[1px] border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-sky-500 focus:outline-none focus:ring-0 focus:border-sky-300 peer" placeholder=" " />
                                    <label for="floating_outlined" class="absolute text-md text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-sky-600 peer-focus:dark:text-sky-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Website</label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="flex mt-6 md:mt-8 items-center space-x-1">
                <p class="text-black font-bold text-xl">{{ user.firstname }}</p>
                 <img class="h-5 w-5 mt-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
            </div>
            <div>
                <p class="text-gray-600">{{ `@${user.email?.split('@')[0]}` }}</p>
            </div>
            <div class="bio leading-5 mt-3 text-[15px] text-gray-800">
                <p>{{ user.bio }}
                </p>
            </div>
            <div class="flex space-x-6">
                <div class="text-[14px] flex mt-3 space-x-1 hover:cursor-pointer hover:underline">
                    <p class="font-bold">{{ userTweet.length }}</p><p class="text-gray-700">Tweets</p>
                </div>
                <div class="text-[14px] flex mt-3 space-x-1 hover:cursor-pointer hover:underline">
                    <p class="font-bold"></p><p class="text-gray-700">Following</p>
                </div>
                <div class="text-[14px] flex mt-3 space-x-1 hover:cursor-pointer hover:underline">
                    <p class="font-bold"></p><p class="text-gray-700">Followers</p>
                </div>
            </div>
        </div>
       <div class="flex justify-between items-center border-b-[1px] border-gray-200 bg-white bg-opacity-80">
            <div class="flex justify-around w-full font-semibold text-center hover:cursor-pointer">
                <div class="relative w-full py-3 hover:bg-gray-200 duration-300 flex-col h-full z-10">
                    <p class="h-full border-b-3">Posts</p>
                    <div class="absolute inset-x-0 bottom-0 w-4/12 h-1 rounded bg-sky-500 mr-auto ml-auto"></div>
                </div>
                <p class="w-full text-gray-600 py-3 hover:bg-gray-200 duration-300">Replies</p>
                <p class="w-full text-gray-600 py-3 hover:bg-gray-200 duration-300">Highlights</p>
                <p class="w-full text-gray-600 py-3 hover:bg-gray-200 duration-300">Media</p>
                <p class="w-full text-gray-600 py-3 hover:bg-gray-200 duration-300">Likes</p>
            </div>
        </div>
</div>   
<div v-for="(tweet, index) in userTweet" :key="index" class="w-full card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
    <div v-if="!user.avatar" class="flex items-center justify-center h-[42px] w-[48px] md:w-[46px] mt-1 bg-stone-700 rounded-full">
        <p :class="`text-white font-bold mb-[1px] text-sm`">{{ `${user.firstname.split("")[0]}${user.lastname.split("")[0]}`}}</p>
    </div>
    <img v-else :src="user.avatar" class="rounded-full w-[42px] h-[38px] md:w-[46px] md:h-[42px] object-cover"/>
    <div class="px-4 w-full">
        <div class="flex justify-between w-full">
            <div class="userinfo flex space-x-1">
                <div class="flex space-x-1 items-center">
                    <p class="font-semibold text-black">{{ user.firstname }}</p>
                    <img class="h-5 w-5 mt-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
                </div>
                <p class="font-light text-gray-800 items-center flex">@{{ user.email.split("@")[0]}}</p>
                <p class="font-light text-gray-500 items-center flex"> · {{ moment(tweet.created_at)?.fromNow() }} </p> 
            </div>
            <div class="relative">
                <div class="hover:bg-sky-200 animation-300 duration-300 rounded-full px-2 py-2">
                    <svg  type="button" @click="activeMenu" :id="index+'Button'" :data-dropdown-toggle="index+'Menu'" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="black" class="bi bi-three-dots hover:cursor-pointer" viewBox="0 0 16 16"> <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg>
                </div>
                <!-- Dropdown menu -->
                <div :id="index+'Menu'" :class="`absolute left-[-140px] z-10 bg-white divide-y divide-gray-100 rounded-lg shadow-2xl w-44 dark:bg-gray-700 overflow-y-hidden ${isActiveMenu==index+'Button' ? 'visible ': 'hidden'}`">
                    <ul class="py-2 text-sm text-black dark:text-gray-200" :aria-labelledby="index+'Button'">
                    <li>
                        <a @click="updatePost(tweet.id)" class="flex px-4 space-x-1 hover:cursor-pointer items-center font-semibold text-black py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="14px" width="14px"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
                            <p>Update</p>
                            </a>
                    </li>
                    <li>
                        <a @click="handleDeletePost(tweet.id)" class="flex hover:cursor-pointer items-center space-x-1 px-4 font-semibold text-black py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16"> <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z"/> </svg>
                            <p>Delete</p>
                        </a>
                    </li>
                    </ul>
                </div>
                <div :id="'edit-Modal'+tweet.id" tabindex="-1" aria-hidden="true" :class="`${ isActivePost == tweet.id ? 'visible' : 'hidden' } overflow-y-hidden overflow-x-hidden fixed top-0 left-0 right-0 bg-black bg-opacity-30 z-50 justify-center items-center w-full h-screen md:inset-0 h-[calc(100%-1rem)] max-h-full`">
                    <div class="relative top-1/2 left-1/2 -translate-x-1/2 mt-[30px] -translate-y-1/2 p-4 w-10/12 md:w-[600px] h-screen">
                        <div class="relative bg-white rounded-2xl shadow dark:bg-gray-700 ">
                            <form>
                            <div class="flex items-center justify-between px-3 py-2 rounded-t dark:border-gray-600">
                                <h3 class="text-sm ml-2 font-bold text-sky-500 dark:text-white">
                                    Update Post
                                </h3>
                                <button type="button" @click="removeActivePost" class="text-gray-900 bg-transparent hover:bg-gray-200 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="flex w-full space-x-2">  
                                <div v-if="!userData.avatar" class="flex items-center justify-center h-[42px] w-[42px] md:w-[46px] bg-stone-700 rounded-full">
                                    <p class="text-white font-bold mb-[1px] text-sm">{{`${userData.firstname?.split("")[0]}${userData.lastname?.split("")[0]}`}}</p>
                                </div>
                                <img v-else :src="userData.avatar" class="ml-3 mt-2 flex rounded-full h-[42px] w-[42px] object-cover"/>
                                <div class="content pt-4  w-full">
                                    <textarea rows="1" v-model="tweet.text" placeholder="What's on your mind?!" class="outline-none border-none text-gray-700 text-lg resize-none w-full overflow-hidden h-auto outline-none border-none focus:outline-none focus:ring-0 focus:ring-offset-0"></textarea>
                                </div>
                            </div>
                            <div v-if="tweet.image&&!isPostImageRemoved" class="relative h-[90px] w-[70px] md:h-[140px] md:w-[100px]">
                                <img :src="tweet.image" class="h-full w-full object-cover ml-14 mt-3 hover:brightness-50 duration-300 transition-300"/>
                                <div @click.prevent="imageRemover" class="absolute md:px-[3px] px-[1px] text-sm hover:cursor-pointer top-[-9px] right-[-65px] md:right-[-70px] z-30 py-[1px] md:py-[3px] rounded-full bg-neutral-800 bg-opacity-60 hover:bg-opacity-90 hover:text-white text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>
                                </div>
                            </div>
                             <div v-if="isAddedPic" class="relative h-[90px] w-[70px] md:h-[140px] md:w-[100px]">
                                <img :src="addedPic" class="h-full w-full object-cover ml-14 mt-3 hover:brightness-50 duration-300 transition-300"/>
                                <div @click.prevent="isAddedRemover" class="absolute md:px-[3px] px-[1px] text-sm hover:cursor-pointer top-[-9px] right-[-65px] md:right-[-70px] z-30 py-[1px] md:py-[3px] rounded-full bg-neutral-800 bg-opacity-60 hover:bg-opacity-90 hover:text-white text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/> </svg>
                                </div>
                            </div>
                            <div class="px-3 py-2 w-full">
                                    <div>
                                        <!-- <img :src="postForm.image"/> -->
                                        <button class="mt-2 flex ml-[5px] space-x-1 px-2 py-1 hover:bg-sky-100 w-auto rounded-full duration-300 transition-300 justify-center"> 
                                            <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1d4mawv r-10ptun7 r-1janqcz" style="rgb(14 165 233);"><g><path fill="rgb(2 132 199)" d="M12 1.75C6.34 1.75 1.75 6.34 1.75 12S6.34 22.25 12 22.25 22.25 17.66 22.25 12 17.66 1.75 12 1.75zm-.25 10.48L10.5 17.5l-2-1.5v-3.5L7.5 9 5.03 7.59c1.42-2.24 3.89-3.75 6.72-3.84L11 6l-2 .5L8.5 9l5 1.5-1.75 1.73zM17 14v-3l-1.5-3 2.88-1.23c1.17 1.42 1.87 3.24 1.87 5.23 0 1.3-.3 2.52-.83 3.61L17 14z"></path></g></svg>
                                            <p class="font-bold text-sm text-sky-500">Everyone can reply</p>
                                        </button>
                                        <hr class="text-black border-0 h-[1px] bg-gray-300 mt-2">
                                    </div>
                                    <div class="interactions pt-2">
                                        <div class="common flex justify-between w-full items-center">
                                            <div class="flex space-x-3">
                                                <div class="hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center hover:bg-blue-100 duration-300 transition-300">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M3 5.5C3 4.119 4.119 3 5.5 3h13C19.881 3 21 4.119 21 5.5v13c0 1.381-1.119 2.5-2.5 2.5h-13C4.119 21 3 19.881 3 18.5v-13zM5.5 5c-.276 0-.5.224-.5.5v9.086l3-3 3 3 5-5 3 3V5.5c0-.276-.224-.5-.5-.5h-13zM19 15.414l-3-3-5 5-3-3-3 3V18.5c0 .276.224.5.5.5h13c.276 0 .5-.224.5-.5v-3.086zM9.75 7C8.784 7 8 7.784 8 8.75s.784 1.75 1.75 1.75 1.75-.784 1.75-1.75S10.716 7 9.75 7z"></path></g></svg>
                                                    <input type="file" @change.prevent="handleImagePostChange" class="absolute w-[20px] opacity-0 hover:cursor-pointer">
                                                </div>
                                                <div class="hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center hover:bg-sky-100 duration-300 transition-300">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M3 5.5C3 4.119 4.12 3 5.5 3h13C19.88 3 21 4.119 21 5.5v13c0 1.381-1.12 2.5-2.5 2.5h-13C4.12 21 3 19.881 3 18.5v-13zM5.5 5c-.28 0-.5.224-.5.5v13c0 .276.22.5.5.5h13c.28 0 .5-.224.5-.5v-13c0-.276-.22-.5-.5-.5h-13zM18 10.711V9.25h-3.74v5.5h1.44v-1.719h1.7V11.57h-1.7v-.859H18zM11.79 9.25h1.44v5.5h-1.44v-5.5zm-3.07 1.375c.34 0 .77.172 1.02.43l1.03-.86c-.51-.601-1.28-.945-2.05-.945C7.19 9.25 6 10.453 6 12s1.19 2.75 2.72 2.75c.85 0 1.54-.344 2.05-.945v-2.149H8.38v1.032H9.4v.515c-.17.086-.42.172-.68.172-.76 0-1.36-.602-1.36-1.375 0-.688.6-1.375 1.36-1.375z"></path></g></svg>
                                                </div>
                                                <div class="hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center hover:bg-sky-100 duration-300 transition-300">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M6 5c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zM2 7c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12V6h10v2zM6 15c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zm-4 2c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12v-2h10v2zM7 7c0 .552-.45 1-1 1s-1-.448-1-1 .45-1 1-1 1 .448 1 1z"></path></g></svg>
                                                </div>
                                                <div class="hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center hover:bg-sky-100 duration-300 transition-300">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M8 9.5C8 8.119 8.672 7 9.5 7S11 8.119 11 9.5 10.328 12 9.5 12 8 10.881 8 9.5zm6.5 2.5c.828 0 1.5-1.119 1.5-2.5S15.328 7 14.5 7 13 8.119 13 9.5s.672 2.5 1.5 2.5zM12 16c-2.224 0-3.021-2.227-3.051-2.316l-1.897.633c.05.15 1.271 3.684 4.949 3.684s4.898-3.533 4.949-3.684l-1.896-.638c-.033.095-.83 2.322-3.053 2.322zm10.25-4.001c0 5.652-4.598 10.25-10.25 10.25S1.75 17.652 1.75 12 6.348 1.75 12 1.75 22.25 6.348 22.25 12zm-2 0c0-4.549-3.701-8.25-8.25-8.25S3.75 7.451 3.75 12s3.701 8.25 8.25 8.25 8.25-3.701 8.25-8.25z"></path></g></svg>
                                                </div>
                                                <div class="hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center hover:bg-sky-100 duration-300 transition-300">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M6 3V2h2v1h6V2h2v1h1.5C18.88 3 20 4.119 20 5.5v2h-2v-2c0-.276-.22-.5-.5-.5H16v1h-2V5H8v1H6V5H4.5c-.28 0-.5.224-.5.5v12c0 .276.22.5.5.5h3v2h-3C3.12 20 2 18.881 2 17.5v-12C2 4.119 3.12 3 4.5 3H6zm9.5 8c-2.49 0-4.5 2.015-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.015 4.5-4.5-2.01-4.5-4.5-4.5zM9 15.5C9 11.91 11.91 9 15.5 9s6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5S9 19.09 9 15.5zm5.5-2.5h2v2.086l1.71 1.707-1.42 1.414-2.29-2.293V13z"></path></g></svg>
                                                </div>
                                                <div class="hover:cursor-pointer w-8 h-8 rounded-full flex justify-center items-center hover:bg-sky-100 duration-300 transition-300">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(29, 155, 240);"><g><path fill="rgb(29, 155, 240)" d="M12 7c-1.93 0-3.5 1.57-3.5 3.5S10.07 14 12 14s3.5-1.57 3.5-3.5S13.93 7 12 7zm0 5c-.827 0-1.5-.673-1.5-1.5S11.173 9 12 9s1.5.673 1.5 1.5S12.827 12 12 12zm0-10c-4.687 0-8.5 3.813-8.5 8.5 0 5.967 7.621 11.116 7.945 11.332l.555.37.555-.37c.324-.216 7.945-5.365 7.945-11.332C20.5 5.813 16.687 2 12 2zm0 17.77c-1.665-1.241-6.5-5.196-6.5-9.27C5.5 6.916 8.416 4 12 4s6.5 2.916 6.5 6.5c0 4.073-4.835 8.028-6.5 9.27z"></path></g></svg>
                                                </div>
                                            </div>
                                            <div class="rare flex space-x-3 items-center">
                                                <button @click.prevent="updatePostHandler(tweet.id, tweet.text, tweet.image)" class="bg-sky-500 text-white font-bold px-5 py-2 rounded-full hover:bg-sky-600" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </div> 
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content pb-2 space-y-2">
            <p>{{ tweet.text }}</p>
            <img :src="tweet.image" class="w-full object-fill rounded-xl"/>
            
        </div>
        <div class="interactions pt-4">
            <div class="common flex justify-between w-full">
                <div class="flex items-center space-x-2">
                    <svg v-if="tweet.like?.some((user)=> user.user_id === userData.id)" @click.prevent="handleUnlike(tweet.id)" style="color: red" xmlns="http://www.w3.org/2000/svg" class="w-5" viewBox="0 0 512 512"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" fill="red"></path></svg>
                    <svg v-else @click.prevent="handleLike(tweet.id)" xmlns="http://www.w3.org/2000/svg" width="18" height="18" :fill="`${dark?'white':'black'}`" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                    <p  v-if="tweet.like.length > 0"  type="button" :class="`text-sm ${dark?'text-white':'text-black'} font-bold`" @mouseleave="removeActiveLike" @mouseover="setActiveLike(tweet.id)">{{tweet.like.length}}</p>
                </div>
                <div :id="`likes-tooltip-${tweet.id}`" :class="`${activeLike==tweet.id ? 'visible' : 'hidden'} absolute z-10 px-3 py-2 ml-2 mt-6 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-100 dark:bg-gray-700`">
                    <b>Likes</b>
                    <p v-for="(size, index) in tweet.like.slice().reverse()" :key="index">
                        {{`${size.user.firstname} ${size.user.lastname}`}}
                    </p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16"> <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/> </svg>
                <svg viewBox="0 0 24 24" aria-hidden="true" width="18" height="18" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1xvli5t r-1hdv0qi"><g><path d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg>
                <svg viewBox="0 0 24 24" aria-hidden="true" width="18" height="18" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1xvli5t r-1hdv0qi"><g><path d="M8.75 21V3h2v18h-2zM18 21V8.5h2V21h-2zM4 21l.004-10h2L6 21H4zm9.248 0v-7h2v7h-2z"></path></g></svg>
                <div class="rare flex space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16"> <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/> </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/> <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/> </svg>
                </div>
            </div>
        </div> 
    </div>
</div>   

<!-- <div class="hover:cursor-pointer card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
    <img src="~/assets/images/profile.jpg" class="rounded-full h-[42px]"/>
    <div class="pl-6">
        <div class="flex justify-between w-full">
            <div class="userinfo flex space-x-1">
                <div class="flex space-x-1 items-center">
                    <p class="font-semibold text-black">Auriel James</p>
                    <img class="h-5 w-5 mt-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
                </div>
                <p class="font-light text-gray-800 items-center flex">@aurieljames11</p>
                <p class="font-light text-gray-500 items-center flex"> · 15h</p> 
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="black" class="bi bi-three-dots" viewBox="0 0 16 16"> <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg>
            </div>
        </div>
        <div class="content">
            <p>One day we gone be living so good these bad days won’t even matter.</p>
        </div>
        <div class="interactions pt-4">
            <div class="common flex justify-between w-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16"> <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/> </svg>
                <svg viewBox="0 0 24 24" aria-hidden="true" width="18" height="18" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1xvli5t r-1hdv0qi"><g><path d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                <svg viewBox="0 0 24 24" aria-hidden="true" width="18" height="18" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1xvli5t r-1hdv0qi"><g><path d="M8.75 21V3h2v18h-2zM18 21V8.5h2V21h-2zM4 21l.004-10h2L6 21H4zm9.248 0v-7h2v7h-2z"></path></g></svg>
                <div class="rare flex space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16"> <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/> </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/> <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/> </svg>
                </div>
            </div>
        </div> 
    </div>
</div>    -->
</div>
</template>
<style></style>