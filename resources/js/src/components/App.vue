<script setup>
import { RouterView } from 'vue-router'
import { useAuthStore } from '@/stores/auth.js';

const authStore = useAuthStore()
const checkUser = () => {
    const token = localStorage.getItem('token')
    if(token) {
        authStore.userInfo.token = token
    }
}

checkUser()
</script>

<template>
    <div class="container">
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
