<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import axiosApiInstance from "../../../../api.js";
import {BRANDS} from "@/constants/index.js";
import {ref} from "vue";
import Loading from "@/components/common/Misc/Loading.vue";
import FilterComponent from "@/components/common/Misc/FilterComponent.vue";
import EmptyContainer from "@/components/common/Misc/EmptyContainer.vue";
import {useRouter} from "vue-router";

const router = useRouter()

const breadcrumbs = [
    {
        name: 'Бренды',
        link: '/brands'
    }
]

const pageTitle = 'Бренды'
const blockTitle = 'Список брендов'

const brands = ref(null);
const loading = ref(true);

const getBrands = async () => {
    let {data} = await axiosApiInstance.get(BRANDS);
    console.log(data.data)
    if(data.data.length > 0) {
        brands.value = data.data
    }
    loading.value = false
}

const handleEdit = (id) => {
    const link = `/brands/${id}`
    router.push(link)
}

const confirmEvent = async (id) => {
    const deleteLink = `${BRANDS}/${id}`
    await axiosApiInstance.delete(deleteLink)
    await getBrands()
}

getBrands();
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <FilterComponent btn-link="/brands/create" />
            <div class="brand-block">
                <Loading v-if="loading" />
                <div class="brand-list" v-if="brands">
                    <el-table :data="brands" style="width: 100%">
                        <el-table-column label="" width="140">
                            <template #default="scope">
                                <div class="img-block">
                                    <router-link :to="'/brands/'+scope.row.id"><img :src="scope.row.img" alt=""></router-link>
                                </div>
                            </template>
                        </el-table-column>
                        <el-table-column label="Название" width="240">
                            <template #default="scope">
                                <p>{{scope.row.name}}</p>
                            </template>
                        </el-table-column>
                        <el-table-column label="На складе">
                            <p class="counter">0</p>
                        </el-table-column>
                        <el-table-column label="Всего">
                            <p class="counter">0</p>
                        </el-table-column>
                        <el-table-column label="Состояние">
                            <template #default="scope">
                                <el-tag type="success" v-if="scope.row.active">Активен</el-tag>
                                <el-tag type="danger" v-else>Не активен</el-tag>
                            </template>

                        </el-table-column>
                        <el-table-column label="Действия" width="190">
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
                <EmptyContainer empty-text="К сожалению ничего нет" v-if="!brands && !loading"/>
            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.brand-block{
    width: 100%;
    height: 100%;
    margin-top: 40px;

    .p-datatable-thead{
        padding-bottom: 10px;
    }
}

.img-block{
    width: 80px;
    height: 80px;

    img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
}

</style>
