<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const toastSuccess = ref("");

</script>
<template>
<aside class="sticky top-0">

    <div class="flex justify-center items-center h-screen bg-white w-full border border-left-2">
        <h1 class="text-3xl text-neutral-800">Im Right side bar</h1>
    </div>
</aside>
</template>
<style></style>