<script setup>

import MainComponent from "@/components/common/MainComponent.vue";
import WorkArea from "@/components/common/WorkArea.vue";
import Loading from "@/components/common/Misc/Loading.vue";
import FilterComponent from "@/components/common/Misc/FilterComponent.vue";
import EmptyContainer from "@/components/common/Misc/EmptyContainer.vue";
import {useRouter} from "vue-router";
import {ref} from "vue";
import axiosApiInstance from "../../../../api.js";
import {PARAMS} from "@/constants/index.js";

const breadcrumbs = [
    {
        name: 'Физ.параметры',
        link: '/phis-parameters'
    }
]

const pageTitle = 'Физ.параметры'
const blockTitle = 'Список параметров'

const router = useRouter();
const loading = ref(true)
const params = ref([])


const getParams = async () => {
    loading.value = true
    let {data} = await axiosApiInstance.get(PARAMS)
    data = data.data
    params.value = data
    loading.value = false
}

const handleEdit = (id) => {
    const link = `/phis-parameters/${id}`
    router.push(link)
}

const confirmEvent = async (id) => {
    const deleteLink = `${PARAMS}/${id}`
    await axiosApiInstance.delete(deleteLink)
    await getParams()
}

getParams()

</script>

<template>
    <MainComponent :breadcrumbs="breadcrumbs" :page-title="pageTitle">
        <WorkArea :block-title="blockTitle">
            <FilterComponent btn-link="/phis-parameters/create" />
            <div class="param-block">
                <Loading v-if="loading" />
                <div class="char-list" v-if="params.length > 0">
                    <el-table :data="params" style="width: 100%">
                        <el-table-column label="Название" width="240">
                            <template #default="scope">
                                <p>{{scope.row.name}}</p>
                            </template>
                        </el-table-column>

                        <el-table-column label="Ед.изм" width="170">
                            <template #default="scope">
                                <p>{{scope.row.measure}}</p>
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
                <EmptyContainer empty-text="К сожалению ничего нет" v-if="params.length < 1 && !loading"/>
            </div>
        </WorkArea>
    </MainComponent>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.param-block{
    margin-top: 20px;
}
</style>
