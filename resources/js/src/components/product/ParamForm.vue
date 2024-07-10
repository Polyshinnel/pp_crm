<script setup>
import {ref} from "vue";
import axiosApiInstance from "../../../api.js";
import {PARAMS} from "@/constants/index.js";
import Loading from "@/components/common/Misc/Loading.vue";

const loading = ref(true);
const params = ref([]);

const formRef = ref('');

const props = defineProps({
    form: Object
})

const getParams = async () => {
    let {data} = await axiosApiInstance.get(PARAMS)
    data = data.data
    console.log(data)
    params.value = data
    loading.value = false
}

const addParam = () => {
    props.form.params.push({
        char_id: 2,
        value: ''
    })
}

const deleteParam = (param) => {
    const index = props.form.params.indexOf(param)
    if(index !== -1) {
        props.form.chars.splice(index, 1)
    }
}

getParams();
</script>

<template>
    <div class="char-block">
        <h2 class="form-title">Физ.параметры</h2>

        <div class="form-wrapper">
            <el-form
                class="product-form"
                label-width="auto"
                ref="formRef"
                label-position="left"
            >
                <el-form-item
                    label="Характеристика"
                    v-for="param in props.form.params"
                >
                    <Loading v-if="loading" />
                    <el-select
                        v-model="param.param_id"
                        placeholder="Параметр"
                        class="select"
                        v-else
                    >
                        <el-option
                            v-for="item in params"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id"
                        />
                    </el-select>
                    <el-input v-model="param.value" class="input" placeholder="Значение" />
                    <el-dropdown trigger="click" class="dropdown">
                        <el-icon class="more-btn"><i class="pi pi-ellipsis-h"></i></el-icon>
                        <template #dropdown>
                            <el-dropdown-menu>
                                <el-dropdown-item @click="addParam">Добавить</el-dropdown-item>
                                <el-dropdown-item @click="deleteParam(param)">Удалить</el-dropdown-item>
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

.char-block{
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
