<script setup>
const props = defineProps({
    icon: String,
    name: String,
    link: String,
    active: Boolean
})

let itemClass = 'sidebar-item';
if(props.active) {
    itemClass = 'sidebar-item sidebar-item_active'
}
</script>

<template>
    <router-link :to="link" class="sidebar-link">
        <div :class="itemClass">
            <div class="img-box">
                <img :src="icon" alt="">
            </div>
            <p>{{name}}</p>
        </div>
    </router-link>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.sidebar-link{
    display: flex;
    width: 100%;
    text-decoration: none;
}

.sidebar-item{
    width: 100%;
    display: flex;
    align-items: center;
    background: #fff;
    padding: 6px;
    border-radius: 3px;
    transition: 0.3s all ease;

    .img-box{
        width: 23px;
        height: 23px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    p{
        margin-left: 15px;
        color: $fontColor;
        font-size: 14px;
    }

    &:hover{
        background: $activeColor;
    }
}

.sidebar-item_active{
    background: $activeColor;
}
</style>
