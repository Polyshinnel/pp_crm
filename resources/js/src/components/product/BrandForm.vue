<script setup>
import Loading from "@/components/common/Misc/Loading.vue";
import {ref} from "vue";
import axiosApiInstance from "../../../api.js";
import {BRANDS} from "@/constants/index.js";

const brands = ref([]);
const loading = ref(true);

const getBrands = async () => {
    let {data} = await axiosApiInstance.get(BRANDS)
    data = data.data
    loading.value = false
    brands.value = data
    if(brands.value.length > 0) {
        props.form.brand_id = brands.value[0].id
    }
}

const formRef = ref('');

const props = defineProps({
    form: Object
})

getBrands();
</script>

<template>
    <div class="brand-block">
        <h2 class="form-title">Бренд</h2>

        <div class="form-wrapper">
            <el-form
                class="product-form"
                label-width="auto"
                ref="formRef"
                label-position="left"
            >
                <el-form-item
                    label="Бренд"
                >
                    <Loading v-if="loading" />
                    <el-select
                        v-model="props.form.brand_id"
                        placeholder="Бренд"
                        class="select"
                        v-else
                    >
                        <el-option
                            v-for="item in brands"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id"
                        />
                    </el-select>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.brand-block{
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
