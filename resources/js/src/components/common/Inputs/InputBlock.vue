<script setup>
defineProps({
    modelValue:String,
    id:String,
    placeholder:String,
    label: String
})

defineEmits(['update:modelValue'])
</script>

<template>
    <div class="input-block">
        <label :for="id">{{label}}</label>
        <input
            :id="id"
            type="text"
            @input="$emit('update:modelValue', $event.target.value)"
            :value="modelValue"
            :placeholder="placeholder"
        >
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.input-block{
    display: flex;
    flex-direction: column;
    width: 230px;

    label{
        font-size: 14px;
        color: $fontColor;
    }

    input{
        margin-top: 4px;
        width: 100%;
        height: 35px;
        border: 1px solid $borderColor;
        padding: 0 10px;
        border-radius: 5px;
    }
}
</style>
