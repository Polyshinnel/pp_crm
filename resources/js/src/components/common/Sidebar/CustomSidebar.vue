<script setup>
import {SIDEBAR} from "@/constants/index.js";
import SidebarBlock from "@/components/common/Sidebar/SidebarBlock.vue";
import {useRoute} from "vue-router";

const route = useRoute()

const routeArr = route.path.split('/')
const currLink = `/${routeArr[1]}`

let sidebarMod = [];

SIDEBAR.forEach((sidebar_item) => {
    let sidebarItems = [];
    sidebar_item.item.forEach((routeItem) => {
        routeItem.active = routeItem.link === currLink;
        sidebarItems.push(routeItem)
    })
    let sidebarObj = {
        key: sidebar_item.key,
        title: sidebar_item.title,
        item: sidebarItems
    }
    sidebarMod.push(sidebarObj)
})

</script>

<template>
    <div class="sidebar-block">
        <img src="@/assets/img/logo.png" alt="">

        <SidebarBlock
            v-for="sidebarItem in sidebarMod"
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
