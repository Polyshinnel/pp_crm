<script setup>
import {ref} from "vue";
import Loading from "@/components/common/Misc/Loading.vue";
import axiosApiInstance from "../../../api.js";
import {CHARS} from "@/constants/index.js";

const loading = ref(true);
const chars = ref([]);

const formRef = ref('');

const props = defineProps({
    form: Object
})

const addChar = () => {
    if(chars.value.length > 0) {
        let charId = chars.value[0].id
        props.form.chars.push({
            char_id: charId,
            value: ''
        })
    }
}

const deleteChar = (char) => {
    const index = props.form.chars.indexOf(char)
    if(index !== -1) {
        props.form.chars.splice(index, 1)
    }
}
const getChars = async () => {
    let {data} = await axiosApiInstance.get(CHARS)
    data = data.data
    chars.value = data
    loading.value = false

    if(chars.value.length > 0) {
        props.form.chars[0].char_id = chars.value[0].id
    }

}

getChars()
</script>

<template>
    <div class="char-block">
        <h2 class="form-title">Характеристики</h2>

        <div class="form-wrapper">
            <el-form
                class="product-form"
                label-width="auto"
                ref="formRef"
                label-position="left"
            >
                <el-form-item
                    label="Характеристика"
                    v-for="char in props.form.chars"
                >
                    <Loading v-if="loading" />
                    <el-select
                        v-model="char.char_id"
                        placeholder="Характеристика"
                        class="select"
                        v-else
                    >
                        <el-option
                            v-for="item in chars"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id"
                        />
                    </el-select>
                    <el-input v-model="char.value" class="input" placeholder="Значение" />
                    <el-dropdown trigger="click" class="dropdown">
                        <el-icon class="more-btn"><i class="pi pi-ellipsis-h"></i></el-icon>
                        <template #dropdown>
                            <el-dropdown-menu>
                                <el-dropdown-item @click="addChar">Добавить</el-dropdown-item>
                                <el-dropdown-item @click="deleteChar(char)">Удалить</el-dropdown-item>
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
