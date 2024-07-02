<script setup>
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import {ref} from "vue";

defineProps({
    btnLink: String
})

const search = ref('');
</script>

<template>
<div class="filter-block">
    <div class="filter-block__filter">
        <div class="input-block input-block_local-input">
            <IconField>
                <InputIcon class="pi pi-search" />
                <InputText v-model="search" placeholder="Поиск по названию" />
            </IconField>
        </div>

        <Button label="" icon="pi pi-filter" iconPos="right" class="filter-btn" />
    </div>
    <router-link :to="btnLink">
        <Button label="Создать" class="common-btn create-btn" />
    </router-link>
</div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.filter-block{
    margin-top: 20px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 30px;
}

.filter-block__filter{
    display: flex;
    align-items: center;
}

.input-block_local-input{
    width: 250px;
    height: 40px;

    .p-inputtext{
        width: 100%;
        height: 40px;
    }

    .p-icon-field > .p-input-icon{
        top: 33%;
    }
}

.create-btn{
    width: 150px;
    height: 40px;
}

.filter-btn{
    width: 40px;
    height: 40px;
    background: #fff;
    border: 1px solid $borderColor;
    color: $fontColor;
    transition: 0.3s all ease;
    margin-left: 10px;

    &:hover{
        background: #f4f4f4;
    }
}
</style>
