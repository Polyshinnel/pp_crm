<script setup>
import {SIDEBAR} from "@/constants/index.js";
import SidebarBlock from "@/components/common/Sidebar/SidebarBlock.vue";

</script>

<template>
    <div class="sidebar-block">
        <img src="@/assets/img/logo.png" alt="">

        <SidebarBlock
            v-for="sidebarItem in SIDEBAR"
            :key="sidebarItem.key"
            :title="sidebarItem.title"
            :items="sidebarItem.item"
        />
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.sidebar-block{
    width: 300px;
    height: 100vh;
    background: #fff;
    overflow: auto;
    border-right: 1px solid $borderColor;
    padding: 20px 30px 50px;
    display: flex;
    align-items: center;
    flex-direction: column;
}
</style>
