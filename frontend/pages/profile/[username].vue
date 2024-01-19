<script setup>
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import useUser from "../../composables/user";
import moment from 'moment';

const { getThisUserData, thisUser } = useUser();
const userTweet = ref({})
const router = useRoute(); 
const username = ref("")
onMounted(()=> {
    username.value = router.fullPath.replace('/profile/', '');
    getThisUserData(username.value).then(()=>{
        userTweet.value = thisUser.value.posts;
        userTweet.value.reverse();
    });
});
</script>
<template>
<div>

 <div class="navbar flex space-x-4 items-center sticky top-0 backdrop-blur-sm bg-white bg-opacity-80 z-20">
        <div class="p-2">
            <NuxtLink to="/home" class="w-10 h-10 py-0 z-20 rounded-full hover:bg-gray-300 flex items-center justify-center duration-300">
              <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(15, 20, 25);"><g><path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z"></path></g></svg>
            </NuxtLink>
        </div>
        <div class="flex flex-col justify-between">
            <div class="flex space-x-1 items-center">
                <p class="font-bold text-xl">{{ thisUser.firstname }}</p>
                <img class="h-5 w-5" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
            </div>
            <p class="text-xs text-gray-700">7,011 tweets</p>
        </div>
    </div>
<div class="profile">
        <div class="cover w-full hover:cursor-pointer">
            <div v-if="!thisUser.cover" class="h-[140px] md:h-[200px] w-full bg-sky-400"></div>
            <img v-else :src="thisUser.cover" class="max-h-[140px] md:max-h-[200px] w-full object-cover"/>
        </div>
        <div class="information py-2 px-5">
            <div class="grid grid-cols-7">
                <div class="col-span-2 profilepic h-5 hover:cursor-pointer w-full">
                    <div v-if="!thisUser.avatar" 
                        class="w-28 h-28 md:w-36 md:h-36 bg-stone-700 rounded-full flex border border-white border-t-[4px] border-l-[3px] border-r-[3px] items-center -mt-16 md:-mt-[86px] justify-center">
                        <p class="text-white mb-2 md:mb-3 font-bold text-3xl md:text-5xl">{{ `${thisUser.firstname?.split("")[0] ? thisUser.firstname?.split("")[0] : "" }${thisUser.lastname?.split("")[0] ? userData.lastname?.split("")[0] : ""}`}}</p>
                    </div>
                    <img v-else :src="thisUser.avatar" 
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
                       id="closeModal" data-modal-target="edit-profile-modal" data-modal-toggle="edit-profile-modal" type="button">Follow</button>
                </div> 
            </div>

            <div class="flex mt-6 md:mt-8 items-center space-x-1">
                <p class="text-black font-bold text-xl">{{ thisUser.firstname }}</p>
                 <img class="h-5 w-5 mt-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
            </div>
            <div>
                <p class="text-gray-600">{{ `@${thisUser.email?.split('@')[0]}` }}</p>
            </div>
            <div class="bio leading-5 mt-3 text-[15px] text-gray-800">
                <p>{{ thisUser.bio }}
                </p>
            </div>
            <div class="flex space-x-6">
                <div class="text-[14px] flex mt-3 space-x-1 hover:cursor-pointer hover:underline">
                    <p class="font-bold">11</p><p class="text-gray-700">Following</p>
                </div>
                <div class="text-[14px] flex mt-3 space-x-1 hover:cursor-pointer hover:underline">
                    <p class="font-bold">379.4K</p><p class="text-gray-700">Followers</p>
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
        <div v-for="(tweet, index) in userTweet" :key="index" class="w-full card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
    <img :src="thisUser.avatar" class="rounded-full w-[42px] h-[38px] md:w-[46px] md:h-[42px] object-cover"/>
    <div class="px-4 w-full">
        <div class="flex justify-between w-full">
            <div class="userinfo flex space-x-1">
                <div class="flex space-x-1 items-center">
                    <p class="font-semibold text-black">{{ thisUser.firstname }}</p>
                    <img class="h-5 w-5 mt-1" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADP0lEQVR4nO2az08TQRTHN+hR/QNM9ODVqAcvBk3ovBZ/HMATEcXon2CigvFUj+AN8aAJmEjnlYSTnk3UgzcjnozExKghUVQOwr63tQqseWyBWrtlpu2sVHnJO3R3uvP5zryZNzuznrdl/7ApTVdB+1e8VjSVD84qpCXQtJzO0UWvlUzlfVCavgNyGDn9SCGd8DaDZe4HexXSW0AaTqOf6XgSbi+/r5APA/LCOnzkCok7cnykvGw2G7ZJeYV8QyG/Oj4R7HEuADDo/R2MPwPyWErz6Yz2DyjNs5Xwa2U1z0oZKSv/UdF/y8oEvc4FKKTbcYCNutI04lwAIL90J4CnnMK3j37dqTQtOuyBxZO5uV3OBEDe73QFDyWXicFJy0fw9MC1AJA68n6n1Fk3cCbPuwG5SyEPAtIzpanoHpz/CCeZWgH5rkK6oPL+fmMBgDydNDBs5JpfGwtQyENJA55/WKjdI8iDxgJSOjiaJPzlR4Xw3bel8M5UMV7ARNBuLEBSPGj+lCT8zELk1URIxu6ZDLd5Niap3jV8/+NC+L4MXlx+91WEk0Ie9WxN5bg7yZafKcGLqCrlu6wFyKLLFfxATMv3V4cPhcWu9WWJW2NVmSQ8lFaxwmT+MoI8v1ngYW0cEIGmUzXh0+j32WTdjeZukwHbbwC/3hNUVNo/VxUekC+tvMMaPmzkedEYoJGWh0rXtAxI1xoSIPCmIE2FxxoCTENI5mhToGbDq1ohZDOIq83hH+aXwutPC+7g0WAQ20yjtUQ0v+XZfBq1SWRxM0u1awP1xjzWkcjESlsfGz68Wk80bcBiqQdy3G0tADTfM60gTkQz4CHyMSv4lR0zy6VEpYgmwofWy+kMBsfqqWhVRDPhoeTykmUTPjfrrUgGayMDFuJ7YailX+qVpjctva2SxsI+77/Z2Ioz2fZzLSCV89OeK+uYDHeApp8uw6bdRcuXm2yBOxOA/MIpfCSARpyFkKZbf+OIaQ6QxwGDHjVOh2puiGn+Ann/YDSWaBiQP5bfT+vgjHMBchAneUISi2RHWXaYHPLJtcolcTYbtskzSnux04kc8pkYaF9t2mNWm1Br2YPuVZPPDFr2U4Mt88zsF/L7hiBlV3/sAAAAAElFTkSuQmCC">
                </div>
                <p class="font-light text-gray-800 items-center flex">@{{ thisUser.email.split("@")[0]}}</p>
                <p class="font-light text-gray-500 items-center flex"> · {{ moment(tweet.created_at)?.fromNow() }} </p> 
            </div>
            <div class="relative">
                <div class="hover:bg-sky-200 animation-300 duration-300 rounded-full px-2 py-2">
                    <svg  type="button" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="black" class="bi bi-three-dots hover:cursor-pointer" viewBox="0 0 16 16"> <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg>
                </div>
                <!-- Dropdown menu -->
                <div :class="`absolute left-[-140px] z-10 bg-white divide-y divide-gray-100 rounded-lg shadow-2xl w-44 dark:bg-gray-700 overflow-y-hidden ${isActiveMenu==index+'Button' ? 'visible': 'invisible'}`">
                    <ul class="py-2 text-sm text-black dark:text-gray-200">
                    <li>
                        <a  class="flex px-4 space-x-1 hover:cursor-pointer items-center font-semibold text-black py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="14px" width="14px"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
                            <p>Update</p>
                            </a>
                    </li>
                    <li>
                        <a class="flex hover:cursor-pointer items-center space-x-1 px-4 font-semibold text-black py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16"> <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z"/> </svg>
                            <p>Delete</p>
                        </a>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content pb-2 space-y-2">
            <p>{{ tweet.text }}</p>
            <img :src="tweet.image" class="w-full object-fill rounded-xl"/>
            
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
</div>   

</div>   
</div>
</template>

<style>
</style>