<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";

const breadcrumbs = [
    {
        name: 'Характеристики',
        link: '/characteristics'
    },
    {
        name: 'Создание характеристики',
        link: '/characteristics'
    }
]

const pageTitle = 'Характеристики'
const blockTitle = 'Создание характеристики'
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
