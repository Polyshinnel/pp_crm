<script setup>
import axiosApiInstance from "../../../api.js";
import {GET_USER} from "@/constants/index.js";
import {ref} from "vue";

const props = defineProps({
    notifications: Number,
    breadcrumbs: Array
})

let breadcrumbs = props.breadcrumbs;
const lastCrumb = breadcrumbs.pop()

const getUserData = async () => {
    const {data} = await axiosApiInstance.get(GET_USER);
    return data.data;
}

const avatar = ref('');
const userName = ref('');

const getUser = async () => {
    const avatarLink = localStorage.getItem('avatar');
    const userNameData = localStorage.getItem('userName');

    if((avatarLink === null) || (userNameData === null)) {
        const userInfo = await getUserData();
        localStorage.setItem('avatar', userInfo.avatar)
        const fullUserName = `${userInfo.second_name} ${userInfo.name}`
        localStorage.setItem('userName', fullUserName)

        avatar.value = userInfo.avatar
        userName.value = fullUserName
    } else {
        avatar.value = avatarLink
        userName.value = userNameData
    }
}

getUser();
</script>

<template>
    <div class="custom-header-block">
        <ul class="breadcrumbs" v-if="breadcrumbs">
            <li
                v-for="breadcrumb in breadcrumbs"
                :key="breadcrumb.name"
            >
                <router-link :to="breadcrumb.link">{{breadcrumb.name}}</router-link>
                &nbsp;/ &nbsp;
            </li>

            <li v-if="lastCrumb">{{lastCrumb.name}}</li>
        </ul>

        <div class="avatar-notifications">
            <div class="notification-block">
                <p>0</p>
                <i class="pi pi-bell"></i>
            </div>
            <div class="avatar-block">
                <img :src="avatar" alt="">
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.custom-header-block{
    height: 64px;
    border-bottom: 1px solid $borderColor;
    background: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.breadcrumbs{
    list-style: none;
    display: flex;

    li{
        color: $primaryColor;
        a{
            color: $primaryColor;
            text-decoration: none;
        }
    }
}

.avatar-notifications{
    display: flex;
    align-items: center;
}

.notification-block{
    display: flex;
    font-size: 14px;
    cursor: pointer;
    color: $cancelColor;

    i{
        margin-left: 5px;
    }
}

.avatar-block{
    margin-left: 20px;
    height: 40px;
    width: 40px;
    border-radius: 50%;
    overflow: hidden;

    img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
}
</style>
