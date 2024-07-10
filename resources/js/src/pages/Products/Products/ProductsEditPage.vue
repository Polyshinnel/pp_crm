<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";

const breadcrumbs = [
    {
        name: 'Товары',
        link: '/products'
    },
    {
        name: 'Редактирование товара',
        link: '/products'
    }
]

const pageTitle = 'Товары'
const blockTitle = 'Редактирование товара'
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">

        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";
</style>
