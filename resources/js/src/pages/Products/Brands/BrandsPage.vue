<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import axiosApiInstance from "../../../../api.js";
import {GET_BRANDS} from "@/constants/index.js";
import {ref} from "vue";
import Loading from "@/components/common/Loading.vue";
import FilterComponent from "@/components/common/FilterComponent.vue";
import Tag from 'primevue/tag';
import EmptyContainer from "@/components/common/EmptyContainer.vue";

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
    let {data} = await axiosApiInstance.get(GET_BRANDS);
    console.log(data.data)
    if(data.data.length > 0) {
        brands.value = data.data
    }
    loading.value = false
}

getBrands();
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <FilterComponent btn-link="/brands/create" />
            <div class="brand-block">
                <Loading v-if="loading" />

                <DataTable :value="brands" tableStyle="min-width: 50rem" v-if="brands">
                    <Column header="Название">
                        <template #body="slotProps">
                            {{slotProps.data.name}}
                        </template>
                    </Column>
                    <Column header="Изображение">
                        <template #body="slotProps">
                            <div class="img-block">
                                <img :src="slotProps.data.img" :alt="slotProps.data.name" />
                            </div>
                        </template>
                    </Column>
                    <Column header="Всего товаров">
                        <template #body="slotProps">
                            <p>0</p>
                        </template>
                    </Column>
                    <Column header="На складе">
                        <template #body="slotProps">
                            <p>0</p>
                        </template>
                    </Column>
                    <Column header="Статус">
                        <template #body="slotProps">
                            <Tag severity="success" value="Активен" v-if="slotProps.data.active"></Tag>
                            <Tag severity="danger" value="Не активен" v-else></Tag>
                        </template>
                    </Column>
                </DataTable>

                <EmptyContainer empty-text="К сожалению ничего нет" v-else/>
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
