<script setup>
import InputText from 'primevue/inputtext';
import {ref} from "vue";
import Divider from 'primevue/divider';
import Password from 'primevue/password';
import Button from 'primevue/button';

const username = ref('');
const password = ref('');
const active = ref(false);

const changeFunc = () => {
    if((username.value.length > 0) && (password.value.length > 0)) {
        active.value = true;
    } else {
        active.value = false;
    }
}
</script>

<template>
    <div class="form-wrapper">
        <div class="form-block">
            <img src="@/assets/img/logo.png" alt="">
            <h1 class="title">Вход</h1>

            <div class="divider-block">
                <Divider />
            </div>

            <div class="input-block__form">
                <label for="username">Электронная почта</label>
                <InputText id="username" name="username" class="input" v-model="username" placeholder="" @change="changeFunc" />
            </div>

            <div class="input-block__form">
                <label for="password">Пароль</label>
                <Password id="password" name="password" class="input password-input" v-model="password" toggleMask :feedback="false" @change="changeFunc" />
                <div class="forgotten-pass">
                    <RouterLink to="/forgotten" class="router-link">Забыли пароль?</RouterLink>
                </div>
            </div>

            <div class="button-block">
                <Button label="Войти" class="common-btn form-btn" v-if="!active" disabled />
                <Button label="Войти" class="common-btn form-btn" v-else />
            </div>

            <div class="register-block">
                <p>Не зарегистрированы? <RouterLink to="/register" class="router-link">Регистрация</RouterLink></p>
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
    margin-top: 10px;

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
