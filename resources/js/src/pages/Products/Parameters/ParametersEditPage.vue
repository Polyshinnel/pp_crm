<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import {useToast} from "primevue/usetoast";
import {useRouter, useRoute} from "vue-router";
import {ref} from "vue";
import axiosApiInstance from "../../../../api.js";
import {CHARS, PARAMS} from "@/constants/index.js";
import InputBlock from "@/components/common/Inputs/InputBlock.vue";
import LoadingBtn from "@/components/common/Misc/LoadingBtn.vue";
import Button from "primevue/button";
import Loading from "@/components/common/Misc/Loading.vue";
import Toast from "primevue/toast";

const breadcrumbs = [
    {
        name: 'Физ.параметры',
        link: '/phis-parameters'
    },
    {
        name: 'Редактирование параметра',
        link: '/phis-parameters'
    }
]

const pageTitle = 'Физ.параметры'
const blockTitle = 'Редактировать параметр'


const toast = useToast()
const router = useRouter()
const route = useRoute()

const loading = ref(false)
const totalLoading = ref(true)
const activeBtn = ref(true)

const charName = ref('')
const measureName = ref('')

const getCharData = async () => {
    const paramId = route.params.paramId
    const link = `${PARAMS}/${paramId}`
    const {data} = await axiosApiInstance.get(link)
    charName.value = data.name
    measureName.value = data.measure
    totalLoading.value = false
}

const saveChanges = async () => {
    loading.value = true

    const obj = {
        name: charName.value,
        measure: measureName.value,
    }

    const paramId = route.params.paramId
    const link = `${PARAMS}/${paramId}`

    try {
        const data = await axiosApiInstance.patch(link, obj)
        loading.value = false
        toast.add({ severity: 'success', summary: 'Сохранено', detail: 'Параметр успешно обновлен!', life: 3000 });
        setTimeout(() => {
            router.push('/phis-parameters')
        }, 1500)
    } catch (e) {
        loading.value = false
        const error = e.response.data.err
        if(error === "This param already exists") {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Такая характеристика уже существует!', life: 3000 });
        } else {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла внутренняя ошибка сервера', life: 3000 });
        }
    }
}

const activateBtn = () => {
    activeBtn.value = charName.value.length > 0;
}

getCharData()
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <Toast/>
            <Loading v-if="totalLoading" />
            <div class="create-char-wrapper" v-if="!totalLoading">
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

.create-char-wrapper{
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
