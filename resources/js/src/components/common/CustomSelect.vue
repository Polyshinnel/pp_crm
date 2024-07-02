<script setup>

defineProps(['modelValue', 'id', 'label', 'optionList'])

defineEmits(['update:modelValue'])
</script>

<template>
<div class="select-block">
    <label :for="id" v-if="label">{{label}}</label>
    <select
        :id="id"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <option
            v-if="optionList"
            v-for="optionItem in optionList"
            :key="optionItem.label"
            :value="optionItem.value"
        >
            {{optionItem.label}}
        </option>
    </select>
</div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.select-block{
    width: 230px;
    display: flex;
    flex-direction: column;

    label{
        font-size: 14px;
        color: $fontColor;
        margin-bottom: 4px;
    }

    select{
        width: 100%;
        height: 35px;
        border: 1px solid $borderColor;
        border-radius: 5px;
        padding: 0 10px;
    }
}
</style>
