<script setup>

import Button from "primevue/button";
import Divider from "primevue/divider";

</script>

<template>
    <div class="form-wrapper">
        <div class="form-block">
            <img src="@/assets/img/logo.png" alt="">
            <h1 class="title">Успешная регистрация</h1>
            <p class="subtitle">Поздравляем! Вы успешно зарегистрировались. Ожидайте подтверждения входа от администратора</p>

            <div class="divider-block">
                <Divider />
            </div>

            <div class="button-block">
                <router-link to="/auth"><Button label="Авторизоваться" class="common-btn form-btn" /></router-link>
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
