<script setup>

</script>

<template>
    <div class="loading-btn">
        <i class="pi pi-spin pi-spinner"></i>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.loading-btn{
    background: $primaryColor;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 8px;

    i{
        color: #fff;
    }
}
</style>
