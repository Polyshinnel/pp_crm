<script setup>
import ScrollPanel from 'primevue/scrollpanel';
defineProps({
    blockTitle: String
})
</script>

<template>
    <div class="workarea-block">
        <h2 class="block-title">{{blockTitle}}</h2>
        <ScrollPanel class="scroll-panel">
            <slot></slot>
        </ScrollPanel>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.workarea-block{
    width: 100%;
    height: calc(100vh - 200px);
    background: #fff;
    border-radius: 10px;
    margin-top: 20px;
    padding: 30px;

    .block-title{
        font-weight: 500;
        color: $fontColor;
    }
}

.scroll-panel{
    width: 100%;
    height: 100%;
}
</style>
