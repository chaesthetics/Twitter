<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

onMounted(()=> {
  console.log(router.currentRoute.value.fullPath);
});

</script>
<template>
  <div class="grid grid-cols-7 md:grid-cols-9 w-full">
    <div class="col-span-1 md:col-span-2" v-if="router.currentRoute.value.fullPath !== '/' && router.currentRoute.value.fullPath !== '/signup'">
      <TheSidebar/>
    </div>
    <div :class="router.currentRoute.value.fullPath === '/' || router.currentRoute.value.fullPath === '/signup' ? 'col-span-9'  : 'col-span-6 md:col-span-7'">
      <NuxtPage />
      <TheFooter v-if="router.currentRoute.value.fullPath === '/signup' || router.currentRoute.value.fullPath === '/'"/>
    </div>
  </div>
</template>
<style></style>