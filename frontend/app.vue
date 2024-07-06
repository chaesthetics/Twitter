<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const toastSuccess = ref("");

const isDarkMode = ref(false);
 
const darkModeToggle = () => {
  isDarkMode.value = !isDarkMode.value;
  console.log(isDarkMode.value);
}

</script>
<template>
  <div class="grid grid-cols-7 md:grid-cols-9 w-full">
    <div class="col-span-1 md:col-span-2" v-if="router.currentRoute.value.fullPath !== '/' && router.currentRoute.value.fullPath !== '/signup'">
      <TheSidebar @my-event="darkModeToggle" :dark="isDarkMode"/>
    </div>
    <div :class="router.currentRoute.value.fullPath === '/' || router.currentRoute.value.fullPath === '/signup' ? 'col-span-9'  : 'col-span-6 md:col-span-4'">
      <NuxtPage :dark="isDarkMode"/>
      <TheFooter v-if="router.currentRoute.value.fullPath === '/signup' || router.currentRoute.value.fullPath === '/'"/>
    </div>
    <div v-if="router.currentRoute.value.fullPath !== '/' && router.currentRoute.value.fullPath !== '/signup'" class="col-span-0 md:col-span-3 hidden md:block">
      <TheRightsidebar :dark="isDarkMode"/>
    </div>
  </div>
</template>
<style></style>