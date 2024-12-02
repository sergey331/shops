<script setup>
defineProps({
    message: String,
    show: Boolean,
})
</script>

<template>
    <!-- Modal Background -->
    <div v-if="show" class="fixed inset-0 z-30 bg-black bg-opacity-50 flex justify-center items-center">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">

            <p class="text-gray-700 mb-4">{{ message }}</p>

        </div>
    </div>
</template>

<style scoped>

</style>
