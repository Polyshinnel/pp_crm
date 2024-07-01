<script setup>

import Button from "primevue/button";
import Divider from "primevue/divider";
import InputText from "primevue/inputtext";
import Password from "primevue/password";
import {ref} from "vue";
import {useAuthStore} from "@/stores/auth.js";
import {useRouter} from "vue-router";
import axios from "axios";
import {REGISTER_URL} from "@/constants/index.js";

const name = ref('');
const second_name = ref('');
const email = ref('');
const pass = ref('');
const confirm_pass = ref('');
const authStore = useAuthStore();
const router = useRouter();

const loading = ref(false)
const registerErr = ref(false)


const checkData = () => {
    let flag = 0;

    if(name.value.length < 2) {
        document.getElementById('name_err').style.display = 'block';
        flag++;
    }
    if(second_name.value.length < 2) {
        document.getElementById('second_name_err').style.display = 'block'
        flag++;
    }
    const re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    const valid_mail = re.test(email.value);
    if(!valid_mail) {
        document.getElementById('email_err').style.display = 'block'
        flag++;
    }

    if(pass.value.length < 6) {
        document.getElementById('pass_err').style.display = 'block'
        flag++;
    }

    if(pass.value !== confirm_pass.value) {
        document.getElementById('confirm_err').style.display = 'block'
        flag++;
    }

    return flag === 0;
}

const resetErr = () => {
    let errors = document.querySelectorAll('.err-text')
    errors.forEach((error) => {
        error.style.display = 'none';
    })
    registerErr.value = false
}

const register = async () => {
    const checkResult = checkData()
    if(checkResult) {
        loading.value = true;
        let obj = {
            name: name.value,
            second_name: second_name.value,
            email: email.value,
            password: pass.value
        }
        try {
            const {data} = await axios.post(REGISTER_URL, obj)
            if(data.err === 'none') {
                await router.push('/success-register')
            }
        } catch (e) {
            loading.value = false
            registerErr.value = true
        }
    }
}
</script>

<template>
    <div class="form-wrapper">
        <div class="form-block">
            <img src="@/assets/img/logo.png" alt="">
            <h1 class="title">Регистрация</h1>

            <div class="divider-block">
                <Divider />
            </div>

            <div class="input-block__form" @click="resetErr">
                <label for="name">Имя</label>
                <InputText id="name" name="name" class="input" v-model="name" placeholder="" />
                <p class="err-text" id="name_err">Имя должно быть не менее 2х символов</p>
            </div>

            <div class="input-block__form" @click="resetErr">
                <label for="second_name">Фамилия</label>
                <InputText id="second_name" name="second_name" class="input" v-model="second_name" placeholder="" />
                <p class="err-text" id="second_name_err">Фамилия должна быть не менее 2х символов</p>
            </div>

            <div class="input-block__form" @click="resetErr">
                <label for="email">Электронная почта</label>
                <InputText id="email" name="email" class="input" v-model="email" placeholder="" />
                <p class="err-text" id="email_err">Введите корректную почту</p>
            </div>

            <div class="input-block__form" @click="resetErr">
                <label for="password">Пароль</label>
                <Password id="password" name="password" class="input password-input" v-model="pass" toggleMask :feedback="false" />
                <p class="err-text" id="pass_err">Пароль должен быть не менее 6 символов</p>
            </div>

            <div class="input-block__form" @click="resetErr">
                <label for="confirm_pass">Повторите пароль</label>
                <Password id="confirm_pass" name="confirm_pass" class="input password-input" v-model="confirm_pass" toggleMask :feedback="false" />
                <p class="err-text" id="confirm_err">Пароли не совпадают</p>
            </div>

            <div class="button-block">
                <Button label="Регистрация" class="common-btn form-btn" v-if="!loading" @click="register" />
                <div class="loading-block" v-else><i class="pi pi-spin pi-spinner"></i></div>
            </div>

            <p class="register-err" v-if="registerErr">Произошла ошибка. Возможно пользователь с такой почтой уже существует!</p>

            <div class="register-block">
                <p>Уже зарегистрированы? <RouterLink to="/auth" class="router-link">Войти</RouterLink></p>
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
    margin-top: 30px;

    .form-btn{
        width: 100%;
        height: 40px;
    }
}

.register-block{
    margin-top: 10px;
    font-size: 14px;
}

.err-text{
    font-size: 12px;
    font-weight: 300;
    color: $cancelColor;
    margin-top: 4px;
    display: none;
}

.register-err{
    margin-top: 5px;
    text-align: center;
    font-size: 12px;
    color: $cancelColor;
    font-weight: 300;
}

.loading-block{
    width: 100%;
    height: 40px;
    border-radius: 5px;
    background: $primaryColor;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
}
</style>
