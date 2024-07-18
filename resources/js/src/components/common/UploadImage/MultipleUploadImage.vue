<script setup>
import {UPLOAD_IMAGE} from "@/constants/index.js";
import {ref} from "vue";

const props = defineProps({
    images: Array
})

const emit = defineEmits([
    'image-set',
])

const imageList = ref([]);
imageList.value = props.images

const uploadData = async (formData) => {
    const data = await axios.post(UPLOAD_IMAGE, formData, {headers: {'Content-Type': 'multipart/form-data'}})
    return data.data
}

const onUpload = async (event) => {
    const file = event.target.files[0]
    let imgUrl = URL.createObjectURL(file)
    let sortOrder = 0;
    if(imageList.value.length > 0) {
        sortOrder = imageList.value[imageList.value.length - 1].sort_order
        sortOrder = parseInt(sortOrder) + 1
    }
    let formData = new FormData();
    formData.append('image', file);
    let data = await uploadData(formData)
    let path = data.path
    let imageObj = {
        img: path,
        sort_order: sortOrder
    }
    imageList.value.push(imageObj)
    emit('image-set', imageList.value)
}

const onDelete = (image) => {
    const index = imageList.value.indexOf(image)
    if(index !== -1) {
        imageList.value.splice(index, 1)
        emit('image-set', imageList.value)
    }
}

</script>

<template>
    <div class="multiple-upload-wrapper">
        <div class="upload-block">
            <label for="image" class="upload-btn">
                <input type="file" name="image" id="image" @change="onUpload">
                <span class="upload-btn__block">
                <img src="@/assets/img/plus.svg" alt="">
            </span>
            </label>
            <p>Изображение</p>
        </div>

        <div class="upload-img"
             v-if="imageList.length > 0"
             v-for="image in imageList"
        >
            <div class="delete-wrapper">
                <div class="icon-block">
                    <i class="pi pi-trash" @click="onDelete(image)"></i>
                </div>
            </div>
            <img :src="image.img" alt="">
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";

.multiple-upload-wrapper{
    display: flex;
    align-items: flex-start;
    width: 100%;
    gap: 20px;
    flex-wrap: wrap;
}

.upload-img{
    width: 110px;
    height: 110px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
    position: relative;

    img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    &:hover{
        .delete-wrapper{
            opacity: 1;
        }
    }
}

.delete-wrapper{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(#000, 0.2);
    opacity: 0;
    transition: 0.3s all ease;

    .icon-block{
        width: 100%;
        padding: 10px;
        color: #fff;
        display: flex;
        justify-content: flex-end;

        i{
            cursor: pointer;
        }
    }
}

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
