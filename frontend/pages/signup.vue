<script setup>

</script>
<template>
<div class="flex justify-around h-screen mt-5">
    <div class="logo flex h-full mt-7">
       <svg viewBox="0 0 24 24" aria-hidden="true" class="h-[0px] md:h-[400px] content-center r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-18jsvk2 r-rxcuwo r-1777fci r-m327ed r-494qqr"><g><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g></svg>
    </div>
    <div class="form jutify-center content-center space-y-4">
        <p class="text-6xl font-bold mt-20 mx-4 mx:px-0 w-5/6 sm:w-4/6">Register na!</p>
        <p class="text-4xl font-bold mx-4 mx:px-0 w-5/6 sm:w-4/6">Join Today.</p>
        <div class="space-y-5 justify-center">
            <div class="flex space-x-2 mx-4 mx:px-0 w-5/6 sm:w-4/6">
                <input class="border-gray-400 border rounded-md text-lg text-black px-3 py-2" placeholder="Enter your Firstname" type="text"/>
                <input class="border-gray-400 border rounded-md text-lg text-black px-3 py-2" placeholder="Enter your Lastname" type="text"/>
            </div>
            <input class="border-gray-400 border mx-4 mx:px-0 w-5/6 sm:w-4/6 rounded-md text-lg text-black px-3 py-2" placeholder="Enter your Email" type="email"/>
             <div class="flex space-x-2 mx-4 mx:px-0 w-5/6 sm:w-4/6">
                <input class="border-gray-400 border rounded-md text-lg text-black px-3 py-2" placeholder="Enter your password" type="password"/>
                <input class="border-gray-400 border rounded-md text-lg text-black px-3 py-2" placeholder="Password confirmation" type="password"/>
            </div>
            <button class="mx-4 mx:px-0 w-5/6 sm:w-4/6 bg-sky-600 hover:bg-sky-700 px-10 py-2 rounded-full text-lg font-bold text-white">Sign Up</button>
        </div>
        <div class="terms flex w-4/6 text-sm mx-4 mx:px-0 w-5/6 sm:w-4/6">
            <p>By signing in, you agree to the <a class="text-blue-400">Terms of Service</a> and <a class="text-blue-400">Privacy Policy</a>, including <a class="text-blue-400">Cookie Use.</a></p>
        </div>
        <div class="mt-10 space-y-3 w-full mx-4 mx:px-0 w-5/6 sm:w-4/6">
            <p class="font-semibold text-2xl mb-4">Already have an account?</p>
            <NuxtLink to="/" class="border border-gray-400 text-sky-500 hover:bg-gray-200 px-10 py-2 rounded-full text-md font-bold text-white">Sign In</NuxtLink>
        </div>
    </div>
</div>
</template>
<style>
</style>