<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import axiosApiInstance from "../../../../api.js";
import {ref} from "vue";
import InputBlock from "@/components/common/Inputs/InputBlock.vue";
import CustomSelect from "@/components/common/Inputs/CustomSelect.vue";
import SingleUploadImage from "@/components/common/UploadImage/SingleUploadImage.vue";
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';
import {useRouter} from "vue-router";
import LoadingBtn from "@/components/common/Misc/LoadingBtn.vue";
import {BRANDS, CHECK_USER} from "@/constants/index.js";

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

const toast = useToast();
const router = useRouter();

const pageTitle = 'Бренды'
const blockTitle = 'Создание бренда'

const brandName = ref('')
const status = ref(true)
const img = ref('');

const active = ref(false)
const loading = ref(false)

const statusList = ref([
    {label: "Активен", value: true},
    {label: "Не активен", value: false},
])

const getImage = (imgPath) => {
    img.value = imgPath
}

const activateBtn = () => {
    active.value = brandName.value.length > 0;
}

const saveChanges = async () => {
    const obj = {
        name: brandName.value,
        img: img.value,
        active: status.value
    }
    loading.value = true

    try {
        const data = await axiosApiInstance.post(BRANDS, obj)
        loading.value = false
        toast.add({ severity: 'success', summary: 'Сохранено', detail: 'Бренд успешно сохранен', life: 3000 });
        setTimeout(() => {
            router.push('/brands')
        }, 1500)
    } catch (e) {
        loading.value = false
        const error = e.response.data.err
        if(error === "This brand already exists") {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Такой бренд уже существует!', life: 3000 });
        } else {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла внутренняя ошибка сервера', life: 3000 });
        }

    }
}
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <Toast/>
            <div class="create-brand-wrapper">
                <div class="create-brand__block">
                    <SingleUploadImage @image-set="getImage"/>
                    <div class="inputs">
                        <InputBlock label="Название" v-model="brandName" id="brand_name" @change="activateBtn"/>
                        <CustomSelect label="Состояние" v-model="status" class="input-select" :option-list="statusList" id="state" />
                    </div>
                </div>

                <div class="button-block">
                    <Button label="Сохранить" class="common-btn save-btn" @click="saveChanges" v-if="active && !loading" />
                    <Button label="Сохранить" class="common-btn save-btn" v-if="!loading && !active" disabled />
                    <LoadingBtn class="loading-btn save-btn" v-if="loading"/>
                </div>

            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.create-brand-wrapper{
    margin-top: 20px;
}

.create-brand__block{
    display: flex;
    align-items: flex-start;

    .inputs{
        margin-left: 30px;
    }
}

.button-block{
    margin-top: 30px;
}

.save-btn{
    width: 180px;
    height: 40px;
}

.input-select{
    margin-top: 5px;
}

</style>
