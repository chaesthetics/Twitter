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
<div class="divide-y-[1px]">
<div class="navbar flex justify-between items-center sticky top-0 backdrop-blur-sm border-b-[1px] border-gray-200 bg-white bg-opacity-80">
    <div class="flex justify-around w-full font-semibold text-center">
        <div class="relative w-full py-4 hover:bg-gray-200 duration-300 flex-col h-full">
            <p class="h-full border-b-3 mb-auto">For you</p>
            <div class="absolute inset-x-0 bottom-0 end-0 content-end self-end mt-auto w-3/12 h-1 rounded bg-sky-500 mr-auto ml-auto"></div>
        </div>
        <p class="w-full text-gray-600 py-4 hover:bg-gray-200 duration-300">Following</p>
    </div>
    <div class="p-2">
        <div class="w-10 h-10 py-0 rounded-full hover:bg-gray-300 flex items-center justify-center duration-300">
            <svg viewBox="0 0 24 24" width="19" height="19" aria-hidden="true" class=" r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-z80fyv r-19wmn03" style="color: rgb(15, 20, 25);"><g><path d="M10.54 1.75h2.92l1.57 2.36c.11.17.32.25.53.21l2.53-.59 2.17 2.17-.58 2.54c-.05.2.04.41.21.53l2.36 1.57v2.92l-2.36 1.57c-.17.12-.26.33-.21.53l.58 2.54-2.17 2.17-2.53-.59c-.21-.04-.42.04-.53.21l-1.57 2.36h-2.92l-1.58-2.36c-.11-.17-.32-.25-.52-.21l-2.54.59-2.17-2.17.58-2.54c.05-.2-.03-.41-.21-.53l-2.35-1.57v-2.92L4.1 8.97c.18-.12.26-.33.21-.53L3.73 5.9 5.9 3.73l2.54.59c.2.04.41-.04.52-.21l1.58-2.36zm1.07 2l-.98 1.47C10.05 6.08 9 6.5 7.99 6.27l-1.46-.34-.6.6.33 1.46c.24 1.01-.18 2.07-1.05 2.64l-1.46.98v.78l1.46.98c.87.57 1.29 1.63 1.05 2.64l-.33 1.46.6.6 1.46-.34c1.01-.23 2.06.19 2.64 1.05l.98 1.47h.78l.97-1.47c.58-.86 1.63-1.28 2.65-1.05l1.45.34.61-.6-.34-1.46c-.23-1.01.18-2.07 1.05-2.64l1.47-.98v-.78l-1.47-.98c-.87-.57-1.28-1.63-1.05-2.64l.34-1.46-.61-.6-1.45.34c-1.02.23-2.07-.19-2.65-1.05l-.97-1.47h-.78zM12 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5c.82 0 1.5-.67 1.5-1.5s-.68-1.5-1.5-1.5zM8.5 12c0-1.93 1.56-3.5 3.5-3.5 1.93 0 3.5 1.57 3.5 3.5s-1.57 3.5-3.5 3.5c-1.94 0-3.5-1.57-3.5-3.5z"></path></g></svg>
        </div>
    </div>
</div>
<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-300">
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
</div>    
<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    

<div class="card flex px-4 py-3 hover:bg-gray-100 duration-200 transition-200">
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
</div>    
</div>
</template>
<style>
</style>