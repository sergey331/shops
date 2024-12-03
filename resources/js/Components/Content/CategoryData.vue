<script setup>
import EditIcon from "@/Components/Icons/EditIcon.vue";
import DeleteIcon from "@/Components/Icons/DeleteIcon.vue";

defineProps({
    categories: Array
})
const emit = defineEmits(["deleteCategory"]);
const deleteCategory = (id) => {
  emit("deleteCategory", id);
}
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
                v-if="categories.length"
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
                       <a :href="route('categories.edit',category.id)">
                            <EditIcon />
                       </a>
                       <button @click="deleteCategory(category.id)">
                           <DeleteIcon />
                       </button>
                   </div>
                </td>
            </tr>
            <tr v-else>
                <td align="center" colspan="6">
                    no data
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<style scoped>

</style>
