<script setup>
defineProps({
    emptyText: String
})
</script>

<template>
    <div class="empty-container">
        <div class="empty-container__block">
            <img src="@/assets/img/empty.svg" alt="">
            <p>{{emptyText}}</p>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.empty-container{
    width: 100%;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.empty-container__block{
    display: flex;
    flex-direction: column;
    align-items: center;

    p{
        text-align: center;
        color: $fontColor;
        margin-top: 10px;
    }
}
</style>
