<script setup>
import {ref} from "vue";
import Loading from "@/components/common/Misc/Loading.vue";
import axiosApiInstance from "../../../api.js";
import {CATEGORIES_TREE_SELECT, CHARS} from "@/constants/index.js";

const loading = ref(true);
const categories = ref([]);

const formRef = ref('');

const props = defineProps({
    form: Object
})

const addCat = () => {
    if(categories.value.length > 0) {
        let category_id = categories.value[0].id
        props.form.categories.push({
            category_id: category_id,
        })
    }
}

const deleteCat = (category) => {
    const index = props.form.categories.indexOf(category)
    if(index !== -1) {
        props.form.categories.splice(index, 1)
    }
}
const getCat = async () => {
    const {data} = await axiosApiInstance.get(CATEGORIES_TREE_SELECT)
    categories.value = data
    loading.value = false

    if(categories.value.length > 0) {
        props.form.categories[0].category_id = categories.value[0].id
    }

}

getCat()
</script>

<template>
    <div class="category-block">
        <h2 class="form-title">Категории</h2>

        <div class="form-wrapper">
            <el-form
                class="product-form"
                label-width="auto"
                ref="formRef"
                label-position="left"
            >
                <el-form-item
                    label="Категория"
                    v-for="category in props.form.categories"
                >
                    <Loading v-if="loading" />
                    <el-tree-select
                        v-else
                        v-model="category.category_id"
                        :data="categories"
                        check-strictly
                        :render-after-expand="false"
                        style="width: 240px"
                    />
                    <el-dropdown trigger="click" class="dropdown">
                        <el-icon class="more-btn"><i class="pi pi-ellipsis-h"></i></el-icon>
                        <template #dropdown>
                            <el-dropdown-menu>
                                <el-dropdown-item @click="addCat">Добавить</el-dropdown-item>
                                <el-dropdown-item @click="deleteCat(category)">Удалить</el-dropdown-item>
                            </el-dropdown-menu>
                        </template>
                    </el-dropdown>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.category-block{
    border: 1px solid $borderColor;
    padding: 20px;
    border-radius: 5px;
    margin-top: 30px;
    margin-right: 20px;
}

.form-wrapper{
    margin-top: 20px;

    .select{
        width: 200px;
    }

    .input{
        width: 200px;
        margin-left: 20px;
    }

    .more-btn{
        margin-left: 20px;
    }
}


</style>
