<script setup>
    defineProps({
        options: Array,
        label: String,
        id: String,
        selected: String | Number,
        title: String,
        modelValue: String,
    })

    const emit = defineEmits(["update:modelValue"]);

    function updateValue(value) {
        emit("update:modelValue", value.target.value);
    }
    defineExpose({ focus: () => input.value.focus() });
</script>

<template>
<div class="mb-4">
    <label :for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
    <select @change="updateValue" :id="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option v-if="title !=='' ">{{ title }}</option>
        <option
            v-if="options?.length"
            v-for="(option,i) in options"
            :selected="selected && selected === option?.id"
            :key="i"
            :value="option.id"
        >{{ option?.name }}
        </option>
    </select>
</div>
</template>
