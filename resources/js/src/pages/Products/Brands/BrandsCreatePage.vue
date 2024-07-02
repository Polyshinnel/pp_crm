<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import axiosApiInstance from "../../../../api.js";
import {ref} from "vue";
import InputBlock from "@/components/common/InputBlock.vue";
import CustomSelect from "@/components/common/CustomSelect.vue";

const breadcrumbs = [
    {
        name: 'Бренды',
        link: '/brands'
    },
    {
        name: 'Создание бренда',
        link: '/brands/create'
    }
]

const pageTitle = 'Бренды'
const blockTitle = 'Создание бренда'

const brandName = ref('')
const status = ref(true)
const img = ref('');

const statusList = ref([
    {label: "Активен", value: true},
    {label: "Не активен", value: false},
])

const getChanges = () => {
    console.log(status.value)
}
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <div class="create-brand-wrapper">
                <InputBlock label="Название" v-model="brandName" id="brand_name"/>
                <CustomSelect label="Состояние" v-model="status" :option-list="statusList" id="state" />
            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.create-brand-wrapper{
    margin-top: 20px;
}
</style>
