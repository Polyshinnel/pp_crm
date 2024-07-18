<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import CharForm from "@/components/product/CharForm.vue";
import {reactive, ref} from "vue";
import ParamForm from "@/components/product/ParamForm.vue";
import axiosApiInstance from "../../../../api.js";
import {PRODUCTS} from "@/constants/index.js";
import InputBlock from "@/components/common/Inputs/InputBlock.vue";
import BrandForm from "@/components/product/BrandForm.vue";
import CategoryForm from "@/components/product/CategoryForm.vue";
import MultipleUploadImage from "@/components/common/UploadImage/MultipleUploadImage.vue";
import Toast from "primevue/toast";
import Button from "primevue/button";
import {useToast} from "primevue/usetoast";
import LoadingBtn from "@/components/common/Misc/LoadingBtn.vue";
import {useRouter} from "vue-router";


const breadcrumbs = [
    {
        name: 'Товары',
        link: '/products'
    },
    {
        name: 'Создание товара',
        link: '/products'
    }
]

const pageTitle = 'Товары'
const blockTitle = 'Создание товара'

const toast = useToast()
const router = useRouter()

const form = reactive({
    name: '',
    description: '',
    cover: '',
    brand_id: '',
    sku: '',
    barcode: '',
    sale_price: 0.00,
    images: [

    ],
    chars: [
        {
            char_id: '',
            value: ''
        }
    ],
    params: [
        {
            param_id: '',
            value: ''
        }
    ],
    categories: [
        {
            category_id: '',
        }
    ],
    title: '',
    description_short: ''
})

const imageSet = (imageList) => {
    form.images = imageList
    console.log(form)
}

const loading = ref(false)

const saveChanges = async () => {
    loading.value = true
    console.log(form)
    try {
        form.cover = form.images[0].img
        await axiosApiInstance.post(PRODUCTS, form)
        loading.value = false
        toast.add({ severity: 'success', summary: 'Сохранено', detail: 'Характеристика успешно сохранена', life: 3000 });
        setTimeout(() => {
            router.push('/products')
        }, 1500)
    } catch (e) {
        const error = e.response.data.err
        console.log(error)
        loading.value = false
        if(error === "This char already exists") {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Такая характеристика уже существует!', life: 3000 });
        } else {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла внутренняя ошибка сервера', life: 3000 });
        }
    }
}

</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <Toast />
            <div class="products-create-block">
                <div class="char-form">
                    <div class="product-common-data__list">
                        <h2>Общие данные</h2>
                        <InputBlock label="Название товара" v-model="form.name" class="input-block" />
                        <div class="input-unit input-block">
                            <label for="">Описание товара</label>
                            <el-input
                                v-model="form.description"
                                style="width: 340px"
                                type="textarea"
                                placeholder=""
                            />
                        </div>
                        <InputBlock label="Штрихкод" v-model="form.barcode" class="input-block" />
                        <InputBlock label="Артикул" v-model="form.sku" class="input-block" />
                        <InputBlock label="Цена продажи" v-model="form.sale_price" class="input-block" />
                    </div>

                    <BrandForm :form="form" />
                    <CategoryForm :form="form" />
                    <CharForm :form="form" />
                    <ParamForm :form="form" />

                    <div class="product-common-data__list">
                        <h2>Данные для сайта</h2>
                        <InputBlock label="Title" v-model="form.title" class="input-block" />
                        <div class="input-unit input-block">
                            <label for="">Description</label>
                            <el-input
                                v-model="form.description_short"
                                style="width: 340px"
                                type="textarea"
                                placeholder=""
                            />
                        </div>
                    </div>

                    <div class="product-common-data__list">
                        <h2>Изображения</h2>

                        <MultipleUploadImage :images="form.images" @image-set="imageSet" />
                    </div>

                    <div class="button-block">
                        <Button label="Сохранить" class="common-btn save-btn" @click="saveChanges" v-if="!loading" />
                        <LoadingBtn class="loading-btn save-btn" v-if="loading"/>
                    </div>
                </div>
            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.input-block{
    margin-top: 10px;
}

.input-unit{
    display: flex;
    flex-direction: column;

    label{
        font-size: 14px;
        margin-bottom: 4px;
    }
}

.product-common-data__list{
    border: 1px solid $borderColor;
    margin-right: 20px;
    border-radius: 5px;
    padding: 20px;
    margin-top: 20px;

    h2{
        margin-bottom: 20px;
    }
}

.button-block{
    margin-top: 30px;
}

.save-btn{
    width: 180px;
    height: 40px;
}
</style>
