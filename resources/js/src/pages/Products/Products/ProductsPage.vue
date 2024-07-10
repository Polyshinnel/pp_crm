<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import {ref} from "vue";
import {useRouter} from "vue-router";
import {BRANDS, PRODUCTS} from "@/constants/index.js";
import axiosApiInstance from "../../../../api.js";
import FilterComponent from "@/components/common/Misc/FilterComponent.vue";
import Loading from "@/components/common/Misc/Loading.vue";
import EmptyContainer from "@/components/common/Misc/EmptyContainer.vue";

const breadcrumbs = [
    {
        name: 'Товары',
        link: '/products'
    }
]

const pageTitle = 'Товары'
const blockTitle = 'Список товаров'


const products = ref([]);
const loading = ref(true);
const router = useRouter();

const getProducts = async () => {
    let {data} = await axiosApiInstance.get(PRODUCTS);
    data = data.data
    products.value = data
    loading.value = false
}

const handleEdit = (id) => {
    const link = `/products/${id}`
    router.push(link)
}

const confirmEvent = async (id) => {
    const deleteLink = `${PRODUCTS}/${id}`
    await axiosApiInstance.delete(deleteLink)
    await getProducts()
}

getProducts()
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <FilterComponent btn-link="/products/create" />

            <Loading v-if="loading" />

            <div class="product-list" v-if="products.length > 0">
                <el-table :data="products" style="width: 100%">
                    <el-table-column label="" width="140">
                        <template #default="scope">
                            <div class="img-block">
                                <router-link :to="'/products/'+scope.row.id"><img :src="scope.row.cover" alt=""></router-link>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column label="Название" width="240">
                        <template #default="scope">
                            <p>{{scope.row.name}}</p>
                        </template>
                    </el-table-column>
                    <el-table-column label="Артикул">
                        <template #default="scope">
                            <p>{{scope.row.sku}}</p>
                        </template>
                    </el-table-column>
                    <el-table-column label="Бренд">
                        <template #default="scope">
                            <p>{{scope.row.brand_name}}</p>
                        </template>
                    </el-table-column>
                    <el-table-column label="Розничная цена">
                        <template #default="scope">
                            <p>{{scope.row.sale_price}}</p>
                        </template>
                    </el-table-column>
                    <el-table-column label="Цена закупки">
                        <template #default="scope">
                            <p>{{scope.row.actual_purchase_price}}</p>
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
            <EmptyContainer empty-text="К сожалению ничего нет" v-if="products.length < 1 && !loading"/>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.product-list{
    margin-top: 30px;
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
