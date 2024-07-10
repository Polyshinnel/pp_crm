<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import CharForm from "@/components/product/CharForm.vue";
import {reactive, ref} from "vue";
import ParamForm from "@/components/product/ParamForm.vue";
import axiosApiInstance from "../../../../api.js";
import {CATEGORIES_TREE_SELECT} from "@/constants/index.js";
import InputBlock from "@/components/common/Inputs/InputBlock.vue";

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

const form = reactive({
    name: '',
    description: '',
    cover: '',
    brand_id: '',
    sku: '',
    barcode: '',
    sale_price: 0.00,
    chars: [
        {
            char_id: 2,
            value: ''
        }
    ],
    params: [
        {
            param_id: 3,
            value: ''
        }
    ],
    categories: [
        {
            category_id: 2,
        }
    ],
    title: '',
    description_short: ''
})

const categories = ref([]);
const categoryLoading = ref(true)
const getCategories = async () => {
    try{
        const {data} = await axiosApiInstance.get(CATEGORIES_TREE_SELECT)
        let list = data
        list.unshift({label:'Корневая категория',value: 0, disabled: false})
        categories.value = list
        categoryLoading.value = false
    } catch (e) {
        console.log(e)
    }
}


const brands = ref([]);
const brandLoading = ref(true);

getCategories();


</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
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

                        <div class="input-unit input-block">

                        </div>

                    </div>
                    <CharForm :form="form" />
                    <ParamForm :form="form" />
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
</style>
