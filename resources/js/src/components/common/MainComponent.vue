<script setup>
import WorkZone from "@/components/common/WorkZone.vue";
import CustomSidebar from "@/components/common/Sidebar/CustomSidebar.vue";
import CustomHeader from "@/components/common/CustomHeader.vue";

defineProps({
    breadcrumbs: Array,
    pageTitle: String
})
</script>

<template>
<div class="main-component-wrapper">
    <CustomSidebar/>
    <div class="workzone-block">
        <CustomHeader :breadcrumbs="breadcrumbs" />

        <WorkZone :page-title="pageTitle">
            <slot></slot>
        </WorkZone>
    </div>

</div>
</template>

<style scoped lang="scss">
@import "@/assets/css/style";
.main-component-wrapper{
    top: 0;
    left: 0;
    position: relative;
    width: 100%;
    height: 100vh;
    background: $bodyColor;
    display: flex;
    align-items: flex-start;
}

.workzone-block{
    width: calc(100% - 300px);
}
</style>
