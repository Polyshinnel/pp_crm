<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import Loading from "@/components/common/Misc/Loading.vue";
import FilterComponent from "@/components/common/Misc/FilterComponent.vue";
import EmptyContainer from "@/components/common/Misc/EmptyContainer.vue";
import {useRouter} from "vue-router";
import {ref} from "vue";
import axiosApiInstance from "../../../../api.js";
import {CHARS} from "@/constants/index.js";

const breadcrumbs = [
    {
        name: 'Характеристики',
        link: '/characteristics'
    }
]

const pageTitle = 'Характеристики'
const blockTitle = 'Список характеристик'

const router = useRouter();
const loading = ref(true)
const chars = ref([])


const getChars = async () => {
    loading.value = true
    let {data} = await axiosApiInstance.get(CHARS)
    data = data.data
    chars.value = data
    loading.value = false
}

const handleEdit = (id) => {
    const link = `/characteristics/${id}`
    router.push(link)
}

const confirmEvent = async (id) => {
    const deleteLink = `${CHARS}/${id}`
    await axiosApiInstance.delete(deleteLink)
    await getChars()
}

getChars()
</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <FilterComponent btn-link="/characteristics/create" />
            <div class="brand-block">
                <Loading v-if="loading" />
                <div class="char-list" v-if="chars.length > 0">
                    <el-table :data="chars" style="width: 100%">
                        <el-table-column label="Название" width="240">
                            <template #default="scope">
                                <p>{{scope.row.name}}</p>
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
                <EmptyContainer empty-text="К сожалению ничего нет" v-if="chars.length < 1 && !loading"/>
            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.char-list{
    margin-top: 20px;
}
</style>
