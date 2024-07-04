<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import FilterComponent from "@/components/common/Misc/FilterComponent.vue";
import {useRouter} from "vue-router";
import {ref} from "vue";
import Loading from "@/components/common/Misc/Loading.vue";
import EmptyContainer from "@/components/common/Misc/EmptyContainer.vue";
import axiosApiInstance from "../../../../api.js";
import {CATEGORIES} from "@/constants/index.js";

const breadcrumbs = [
    {
        name: 'Категории',
        link: '/categories'
    }
]

const pageTitle = 'Категории'
const blockTitle = 'Список категорий'

const router = useRouter();

const categories = ref([]);
const loading = ref(true);

const getCategories = async () => {
    try {
        let {data} = await axiosApiInstance.get(CATEGORIES)
        loading.value = false
        console.log(data)
        categories.value = data
    } catch (e) {
        loading.value = false
        console.log(e)
    }
}

const handleEdit = (id) => {
    const link = `/categories/${id}`
    router.push(link)
}

const confirmEvent = async (id) => {
    const link = `${CATEGORIES}/${id}`
    await axiosApiInstance.delete(link)
    await getCategories()
}

getCategories();
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <FilterComponent btn-link="/categories/create" />

            <Loading v-if="loading" />

            <EmptyContainer v-if="!loading && categories.length === 0" emptyText="Нет доступных категорий" />

            <div class="category-wrapper" v-if="categories.length > 0">
                <el-table class="table"
                          :data="categories"
                          style="width: 100%; margin-bottom: 20px"
                          row-key="id"
                >
                    <el-table-column prop="name" width="340" label="Название" />
                    <el-table-column prop="warehouse_count" label="На складе" />
                    <el-table-column prop="catalog_count" label="В каталоге" />
                    <el-table-column prop="status" label="Статус">
                        <template #default="scope">
                            <el-tag v-if="scope.row.status" type="success">Активный</el-tag>
                            <el-tag v-else type="danger">Не активный</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column label="Действия">
                        <template #default="scope">
                            <el-button size="small" @click="handleEdit(scope.row.id)">
                                Ред.
                            </el-button>

                            <el-popconfirm
                                title="Уверены что хотите удалить?"
                                @confirm="confirmEvent(scope.row.id)"
                                confirm-button-text="Да"
                                cancel-button-text="Нет"
                                width="220"
                            >им
                                <template #reference>
                                    <el-button
                                        size="small"
                                        type="danger"
                                    >
                                        Удал.
                                    </el-button>
                                </template>
                            </el-popconfirm>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.category-wrapper{
    margin-top: 20px;
}
</style>
