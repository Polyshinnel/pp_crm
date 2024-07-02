<script setup>

</script>

<template>
    <div class="loading-wrapper">
        <i class="pi pi-spin pi-spinner"></i>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.loading-wrapper{
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

    i{
        font-size: 30px;
        color: $primaryColor;
    }
}
</style>
