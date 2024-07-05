<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import LoadingBtn from "@/components/common/Misc/LoadingBtn.vue";
import Toast from "primevue/toast";
import Button from "primevue/button";
import InputBlock from "@/components/common/Inputs/InputBlock.vue";
import {useRouter} from "vue-router";
import {useToast} from "primevue/usetoast";
import {ref} from "vue";
import axiosApiInstance from "../../../../api.js";
import {CHARS, PARAMS} from "@/constants/index.js";

const breadcrumbs = [
    {
        name: 'Физ.параметры',
        link: '/phis-parameters'
    },
    {
        name: 'Создание параметра',
        link: '/phis-parameters'
    }
]

const pageTitle = 'Физ.параметры'
const blockTitle = 'Создать параметр'

const toast = useToast()
const router = useRouter()

const loading = ref(false)
const activeBtn = ref(false)

const charName = ref('')
const measureName = ref('')

const saveChanges = async () => {
    loading.value = true

    const obj = {
        name: charName.value,
        measure: measureName.value
    }

    try {
        const data = await axiosApiInstance.post(PARAMS, obj)
        loading.value = false
        toast.add({ severity: 'success', summary: 'Сохранено', detail: 'Параметра успешно сохранен', life: 3000 });
        setTimeout(() => {
            router.push('/phis-parameters')
        }, 1500)
    } catch (e) {
        loading.value = false
        const error = e.response.data.err
        if(error === "This params already exists") {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Такой параметр уже существует!', life: 3000 });
        } else {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла внутренняя ошибка сервера', life: 3000 });
        }
    }
}

const activateBtn = () => {
    activeBtn.value = charName.value.length > 0 && measureName.value.length > 0;
}
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <Toast/>
            <div class="create-param-wrapper">
                <div class="inputs">
                    <InputBlock label="Название" v-model="charName" id="param_name" @change="activateBtn"/>
                    <InputBlock label="Ед.Измерения" v-model="measureName" id="measure_name" @change="activateBtn" class="param_input"/>
                </div>

                <div class="button-block">
                    <Button label="Сохранить" class="common-btn save-btn" @click="saveChanges" v-if="activeBtn && !loading" />
                    <Button label="Сохранить" class="common-btn save-btn" v-if="!loading && !activeBtn" disabled />
                    <LoadingBtn class="loading-btn save-btn" v-if="loading"/>
                </div>

            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.create-param-wrapper{
    margin-top: 20px;
}

.button-block{
    margin-top: 30px;
}

.save-btn{
    width: 180px;
    height: 40px;
}

.param_input{
    margin-top: 10px;
}
</style>
