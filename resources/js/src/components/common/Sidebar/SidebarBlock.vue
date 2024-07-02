<script setup>
import {ref} from "vue";
import Divider from 'primevue/divider';
import SidebarItem from "@/components/common/Sidebar/SidebarItem.vue";

const props = defineProps({
    items: Array,
    title: String,
})


</script>

<template>
    <div class="sidebar-block-unit">
        <div class="sidebar-block__title" v-if="props.title">
            <h2>{{title}}</h2>
            <Divider class="divider-item" />
        </div>
        <div class="sidebar-block__body" v-if="items">
            <SidebarItem
                v-for="item in items"
                :key="item.name"
                :name="item.name"
                :icon="item.icon"
                :link="item.link"
                :active="item.active"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.sidebar-block-unit{
    width: 100%;
    margin-top: 20px;
}

.sidebar-block__title{
    margin-bottom: 15px;

    h2{
        font-size: 16px;
        color: $fontColor;
    }

    .divider-item{
        margin-top: 7px;
    }
}

</style>
