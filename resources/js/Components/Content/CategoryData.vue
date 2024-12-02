<script setup>
import {router} from "@inertiajs/vue3";
import EditIcon from "@/Components/Icons/EditIcon.vue";
import DeleteIcon from "@/Components/Icons/DeleteIcon.vue";

defineProps({
    categories: Array
})
</script>

<template>


    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="text-center">
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Slug
                </th>
                <th scope="col" class="px-6 py-3">
                    Parent Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="category in categories" :key="category.id"
                class="bg-white border-b dark:bg-gray-800  text-center dark:border-gray-700"
            >
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ category.id}}
                </th>
                <td class="px-6 py-4">
                    {{ category.name }}
                </td>
                <td class="px-6 py-4">
                    {{ category.slug }}
                </td>
                <td class="px-6 py-4">
                    {{ category.parent_id ? category.parent.name : "-" }}
                </td>
                <td class="px-6 py-4">
                    <img width="50" class="m-auto" :src="`/storage/categories/${category.image}`" alt=""/>
                </td>
                <td class="px-6 py-4">
                   <div class="flex items-center justify-center gap-4"   >
                       <a :href="route('categories.update',category.id)">
                            <EditIcon />
                       </a>
                       <a :href="route('categories.update',category.id)">
                           <DeleteIcon />
                       </a>
                   </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<style scoped>

</style>
