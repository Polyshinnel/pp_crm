<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import {useRoute, useRouter} from "vue-router";
import axiosApiInstance from "../../../../api.js";
import {BRANDS} from "@/constants/index.js";
import {ref} from "vue";
import Loading from "@/components/common/Misc/Loading.vue";
import CustomSelect from "@/components/common/Inputs/CustomSelect.vue";
import LoadingBtn from "@/components/common/Misc/LoadingBtn.vue";
import Toast from "primevue/toast";
import InputBlock from "@/components/common/Inputs/InputBlock.vue";
import Button from "primevue/button";
import SingleUploadImage from "@/components/common/UploadImage/SingleUploadImage.vue";
import {useToast} from "primevue/usetoast";

const route = useRoute()
const router = useRouter()
const brandId = route.params.brandId

const loadingData = ref(true)
const loading = ref(false)

const toast = useToast();

const img = ref('')
const active = ref(true)
const status = ref(true)
const brandName = ref('')

const getBrandData = async () => {
    const link = `${BRANDS}/${brandId}`
    try{
        const {data} = await axiosApiInstance.get(link)
        brandName.value = data.name
        img.value = data.img
        if(data.active == 0) {
            status.value = false
        }


        const breadcrumbObj = {
            name: data.name,
            link: `/brands/${brandId}`
        }
        breadcrumbs.value.push(breadcrumbObj)

        loadingData.value = false
        console.log(status.value)
    } catch (e) {
        console.log(e)
        loadingData.value = false
    }
}

const activateBtn = () => {
    active.value = brandName.value.length > 0
}

const statusList = ref([
    {label: "Активен", value: true},
    {label: "Не активен", value: false},
])

const breadcrumbs = ref([
    {
        name: 'Бренды',
        link: '/brands'
    }
])

const pageTitle = 'Бренды'
const blockTitle = 'Редактирование бренда'



const getImage = (imgPath) => {
    img.value = imgPath
}

const saveChanges = async () => {
    const activeStatus = status.value == 'true'
    const obj = {
        name: brandName.value,
        img: img.value,
        active: activeStatus
    }
    loading.value = true

    try {
        const link = `${BRANDS}/${brandId}`
        const data = await axiosApiInstance.patch(link, obj)
        loading.value = false
        toast.add({ severity: 'success', summary: 'Сохранено', detail: 'Бренд успешно сохранен', life: 3000 });
        setTimeout(() => {
            router.push('/brands')
        }, 1500)
    } catch (e) {
        loading.value = false
        const error = e.response.data.err
        toast.add({severity: 'error', summary: 'Ошибка', detail: 'Произошла внутренняя ошибка сервера', life: 3000});
    }
}

getBrandData()
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <Toast/>
            <Loading v-if="loadingData" />
            <div class="create-brand-wrapper" v-else>
                <div class="create-brand__block">
                    <SingleUploadImage @image-set="getImage" :image="img"/>
                    <div class="inputs">
                        <InputBlock label="Название" v-model="brandName" id="brand_name" @change="activateBtn"/>
                        <CustomSelect label="Состояние" v-model="status" class="input-select" :option-list="statusList" id="state" />
                    </div>
                </div>

                <div class="button-block">
                    <Button label="Обновить" class="common-btn save-btn" @click="saveChanges" v-if="active && !loading" />
                    <Button label="Обновить" class="common-btn save-btn" v-if="!loading && !active" disabled />
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
