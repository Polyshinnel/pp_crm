<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import {useToast} from "primevue/usetoast";
import {useRouter} from "vue-router";
import {ref} from "vue";
import InputBlock from "@/components/common/Inputs/InputBlock.vue";
import CustomSelect from "@/components/common/Inputs/CustomSelect.vue";
import Loading from "@/components/common/Misc/Loading.vue";
import axiosApiInstance from "../../../../api.js";
import {CATEGORIES, CATEGORIES_TREE_SELECT} from "@/constants/index.js";
import LoadingBtn from "@/components/common/Misc/LoadingBtn.vue";
import Button from "primevue/button";
import Toast from 'primevue/toast';

const breadcrumbs = [
    {
        name: 'Категории',
        link: '/categories'
    },
    {
        name: 'Создание категории',
        link: '/categories'
    }
]

const pageTitle = 'Категории'
const blockTitle = 'Создание категории'

const toast = useToast();
const router = useRouter();

const categoryName = ref('');
const categoryDescription = ref('');
const categoryStatus = ref(true)
const categoryParentId = ref(0)

const loading = ref(true)
const categoryList = ref([])
const btnActive = ref(false)

const loadingData = ref(false)

const statusList = [
    {
        label: 'Активен',
        value: true
    },
    {
        label: 'Не активен',
        value: false
    },
]

const activateBtn = () => {
    btnActive.value = categoryName.value.length > 0;
}

const getCategories = async () => {
    try{
        const {data} = await axiosApiInstance.get(CATEGORIES_TREE_SELECT)
        let list = data
        list.unshift({label:'Корневая категория',value: 0, disabled: false})
        categoryList.value = list
        loading.value = false
    }catch (e) {
        console.log(e)
    }
}

const saveChanges = async () => {
    const obj = {
        name: categoryName.value,
        description: categoryDescription.value.length > 0 ? categoryDescription.value : '',
        parent_id: categoryParentId.value,
        status: categoryStatus.value
    }

    console.log(obj)

    try{
        loadingData.value = true
        await axiosApiInstance.post(CATEGORIES, obj)
        toast.add({ severity: 'success', summary: 'Сохранено', detail: 'Категория успешно создана!', life: 3000 });
        setTimeout(() => {
            router.push('/categories')
        }, 1500)
    } catch (e) {
        loadingData.value = false

        const error = e.response.data.err
        console.log(error)
        if(error === "This category already exists") {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Такая категория уже существует!', life: 3000 });
        } else {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла внутренняя ошибка сервера', life: 3000 });
        }
    }
}

getCategories()
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <Toast/>
            <div class="category-create__block">
                <InputBlock id="category_name" label="Название" v-model="categoryName" @change="activateBtn" />
                <div class="category-item text-area-block">
                    <label>Описание</label>
                    <el-input
                        v-model="categoryDescription"
                        type="textarea"
                    />
                </div>
                <CustomSelect class="category-item" id="category_status" label="Статус" :option-list="statusList" v-model="categoryStatus" />

                <div class="category-parent-block category-item">
                    <Loading v-if="loading" />
                    <el-tree-select
                        v-if="!loading && categoryList.length > 0"
                        v-model="categoryParentId"
                        filterable
                        placeholder="Подкатегория"
                        :data="categoryList"
                        class="category-parent-block_select"
                    />
                </div>

                <div class="button-block">
                    <Button label="Сохранить" class="common-btn save-btn" @click="saveChanges" v-if="btnActive && !loadingData" />
                    <Button label="Сохранить" class="common-btn save-btn" v-if="!loadingData && !btnActive" disabled />
                    <LoadingBtn class="loading-btn save-btn" v-if="loadingData"/>
                </div>
            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.category-create__block{
    margin-top: 30px;
}

.save-btn{
    width: 180px;
    height: 40px;
}

.category-item{
    width: 230px;
    margin-top: 15px;
}

.text-area-block{
    width: 270px;

    label{
        font-size: 14px;
        margin-bottom: 4px;
    }
}

.button-block{
    margin-top: 20px;
}

.category-parent-block_select{
    width: 100%;
    height: 35px;
    margin-top: 10px;
}
</style>
