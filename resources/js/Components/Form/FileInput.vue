<script setup>
defineProps({

    error: Array | String
})
</script>

<template>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="file_input" type="file">
        <div v-if="typeof error === `object` "
             class="text-sm font-medium text text-red-500 "
             v-for="(e,i) in error" :key="i"
        >
            {{ e }}
        </div>
        <div v-else-if="error !== '' " class="text-sm font-medium text text-red-500 ">
            {{ error }}
        </div>
    </div>
</template>

<style scoped>

</style>
