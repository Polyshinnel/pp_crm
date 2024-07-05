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
import {CHARS} from "@/constants/index.js";


const breadcrumbs = [
    {
        name: 'Характеристики',
        link: '/characteristics'
    },
    {
        name: 'Создание характеристики',
        link: '/characteristics'
    }
]

const pageTitle = 'Характеристики'
const blockTitle = 'Создание характеристики'

const toast = useToast()
const router = useRouter()

const loading = ref(false)
const activeBtn = ref(false)

const charName = ref('')

const saveChanges = async () => {
    loading.value = true

    const obj = {
        name: charName.value
    }

    try {
        const data = await axiosApiInstance.post(CHARS, obj)
        loading.value = false
        toast.add({ severity: 'success', summary: 'Сохранено', detail: 'Характеристика успешно сохранена', life: 3000 });
        setTimeout(() => {
            router.push('/characteristics')
        }, 1500)
    } catch (e) {
        loading.value = false
        const error = e.response.data.err
        if(error === "This char already exists") {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Такая характеристика уже существует!', life: 3000 });
        } else {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла внутренняя ошибка сервера', life: 3000 });
        }
    }
}

const activateBtn = () => {
    activeBtn.value = charName.value.length > 0;
}
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <Toast/>
            <div class="create-char-wrapper">
                <div class="inputs">
                    <InputBlock label="Название" v-model="charName" id="brand_name" @change="activateBtn"/>
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
</style>
