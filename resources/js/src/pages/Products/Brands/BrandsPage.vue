<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import axiosApiInstance from "../../../../api.js";
import {BRANDS} from "@/constants/index.js";
import {ref} from "vue";
import Loading from "@/components/common/Misc/Loading.vue";
import FilterComponent from "@/components/common/Misc/FilterComponent.vue";
import Tag from 'primevue/tag';
import EmptyContainer from "@/components/common/Misc/EmptyContainer.vue";
import Menu from 'primevue/menu';

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

const menu = ref();
const items = ref([
    {
        label: 'Options',
        items: [
            {
                label: 'Refresh',
                icon: 'pi pi-refresh'
            },
            {
                label: 'Export',
                icon: 'pi pi-upload'
            }
        ]
    }
]);
const toggle = (event) => {
    menu.value.toggle(event);
    console.log(menu.value);
};

getBrands();
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <FilterComponent btn-link="/brands/create" />
            <div class="brand-block">
                <Loading v-if="loading" />
                <div class="table-block" v-if="brands">
                    <div class="table-header">
                        <div class="table-header__item table-row__item_name">
                            <p>Название</p>
                        </div>
                        <div class="table-header__item table-row__item_img">
                            <p>Изображение</p>
                        </div>
                        <div class="table-header__item table-row__item_count">
                            <p>Товаров всего</p>
                        </div>
                        <div class="table-header__item table-row__item_count">
                            <p>На складе</p>
                        </div>
                        <div class="table-header__item table-row__item_tag">
                            <p>Статус</p>
                        </div>
                    </div>
                    <div class="table-row"
                         v-for="brand in brands"
                         :key="brand.id"
                    >
                        <div class="table-row__item table-row__item_name">
                            <p>{{brand.name}}</p>
                        </div>

                        <div class="table-row__item table-row__item_img">
                            <div class="img-container">
                                <img :src="brand.img" alt="">
                            </div>
                        </div>

                        <div class="table-row__item table-row__item_count">
                            <p>0</p>
                        </div>

                        <div class="table-row__item table-row__item_count">
                            <p>0</p>
                        </div>

                        <div class="table-row__item table-row__item_tag">
                            <Tag icon="pi pi-check" severity="success" value="Активен" v-if="brand.active"></Tag>
                            <Tag icon="pi pi-times" severity="danger" value="Не активен" v-else></Tag>
                        </div>

                        <div class="table-row__item table-row__item-menu">
                            <div class="table-row__item-menu-btn" @click="toggle" aria-haspopup="true" aria-controls="overlay_menu">
                                <i class="pi pi-ellipsis-h"></i>
                            </div>
                        </div>

                        <Menu ref="menu" id="overlay_menu" :model="items" :popup="true">
                            <template>
                                <div class="menu-btn"><span>Редактировать</span></div>
                            </template>
                            <template>
                                <div class="menu-btn"><span>Удалить</span></div>
                            </template>
                        </Menu>
                    </div>
                </div>
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
