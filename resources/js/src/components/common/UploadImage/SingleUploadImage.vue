<script setup>
import {ref} from "vue";
import {UPLOAD_IMAGE} from "@/constants/index.js";

const props = defineProps({
    name: String,
    image: String
})

const emit = defineEmits([
    'image-set',
])

const userImage = ref('');
userImage.value = props.image

const uploadData = async (formData) => {
    const data = await axios.post(UPLOAD_IMAGE, formData, {headers: {'Content-Type': 'multipart/form-data'}})
    return data.data
}

const onUpload = async (event) => {
    const file = event.target.files[0]
    userImage.value = URL.createObjectURL(file)
    let formData = new FormData();
    formData.append('image', file);
    let data = await uploadData(formData)
    let path = data.path
    emit('image-set', path)
}
</script>

<template>
    <div class="upload-block">
        <label for="image" class="upload-btn">
            <input type="file" name="image" id="image" @change="onUpload">
            <span class="upload-btn__block">
                <img src="@/assets/img/plus.svg" v-if="!userImage" alt="">
                <img :src="userImage" v-else alt="" class="current-img">
            </span>
        </label>
        <p>Изображение</p>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.upload-block{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 110px;

    p{
        font-size: 12px;
        color: $fontColor;
        margin-top: 4px;
        text-align: center;
    }
}

.upload-btn{
    input{
        width: 0;
        position: absolute;
        z-index: -1;
    }

    .upload-btn__block{
        width: 110px;
        height: 110px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    .current-img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
}
</style>
