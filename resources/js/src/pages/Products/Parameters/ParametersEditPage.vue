<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";

const breadcrumbs = [
    {
        name: 'Физ.параметры',
        link: '/parameters'
    },
    {
        name: 'Редактирование параметра',
        link: '/parameters'
    }
]

const pageTitle = 'Физ.параметры'
const blockTitle = 'Редактировать параметр'
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