<script setup>
defineProps({
    pageTitle: String
})
</script>

<template>
    <div class="work-zone-wrapper">
        <h1 class="page-title">{{pageTitle}}</h1>
        <slot></slot>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.work-zone-wrapper{
    padding: 20px;
}
</style>
