<script setup>

import Button from "primevue/button";
import Divider from "primevue/divider";
import InputText from "primevue/inputtext";
import Password from "primevue/password";
import {ref} from "vue";

const username = ref('')
const active = ref(false);

const checkEmail = () => {
    const re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    active.value = re.test(username.value);
}
</script>

<template>
    <div class="form-wrapper">
        <div class="form-block">
            <img src="@/assets/img/logo.png" alt="">
            <h1 class="title">Восстановить пароль</h1>
            <p class="subtitle">Инструкция по восстановлению пароля придет на почту</p>

            <div class="divider-block">
                <Divider />
            </div>

            <div class="input-block__form">
                <label for="username">Электронная почта</label>
                <InputText id="username" name="username" class="input" v-model="username" placeholder="" @change="checkEmail" />
            </div>

            <div class="button-block">
                <Button label="Сбросить пароль" class="common-btn form-btn" v-if="!active" disabled />
                <Button label="Сбросить пароль" class="common-btn form-btn" v-else />
            </div>

            <div class="register-block">
                <p>Вспомнили пароль? <RouterLink to="/auth" class="router-link">Войти</RouterLink></p>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.form-wrapper{
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-block{
    width: 400px;
    padding: 30px;
    border-radius: 10px;
    border: 1px solid $borderColor;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.title{
    margin-top: 15px;
    text-align: center;
}

.subtitle{
    font-size: 14px;
    font-weight: 300;
    margin-top: 10px;
    text-align: center;
}

.divider-block{
    width: 100%;
    margin: 15px 0;
}

.input-block__form{
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    width: 100%;

    label{
        margin-bottom: 4px;
        font-size: 14px;
    }

    .input{
        width: 100%;
        height: 35px;
    }

    .forgotten-pass{
        width: 100%;
        display: flex;
        justify-content: flex-end;
        margin-top: 5px;
        font-size: 14px;
    }
}

.button-block{
    width: 100%;
    margin-top: 20px;

    .form-btn{
        width: 100%;
        height: 40px;
    }
}

.register-block{
    margin-top: 10px;
    font-size: 14px;
}
</style>
