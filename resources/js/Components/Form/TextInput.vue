<script setup>
defineProps({
    type: String,
    placeholder: String,
    label: String,
    id: String,
    modelValue: String,
    error: String
})

const emit = defineEmits(["update:modelValue"]);

function updateValue(value) {
    emit("update:modelValue", value);
}

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <div class="mb-4">
        <label
            :for="id"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        >
            {{ label }}
        </label>
        <input
            @input="updateValue($event.target.value)"
            :type="type" :id="id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            :placeholder="placeholder"
        />

        <div v-if="error !== '' " class="text-sm font-medium text text-red-500 ">
            {{ error }}
        </div>
    </div>
</template>
