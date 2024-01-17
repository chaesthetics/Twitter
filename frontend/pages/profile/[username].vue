<script setup>
import { onMounted } from "vue";
import { useRoute } from "vue-router";

const router = useRoute(); 
const username = ref("")
onMounted(()=> {
    username.value = router.fullPath.replace('/profile/', '');
    // getThisUserData(username.value);
});
</script>
<template>
    <h1>
        
    </h1>
</template>

<style>
</style>