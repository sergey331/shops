<script setup>
    import AdminLayout from "@/Layouts/AdminLayout.vue";
    import CategoryData from "@/Components/Content/CategoryData.vue";
    import Pagination from "@/Components/Pagination.vue";
    import axios from "axios";


    defineProps({
        categories: Array,
        currentPage: Number,
    })


    const  changeCurrentPage = (page) => {
        location.href="/admin/categories?page=" + page;
    }

    const deleteCategory = id => {
        axios.delete(route('categories.destroy',id))
        .then(({data}) => {
            if (data) {
                location.reload();
            }
        })
    }
</script>

<template>
    <admin-layout>

        <div class="max-w-7xl mx-auto  mt-8" >
            <div class="flex items-center gap-10 "  >
                <h2 class="text-black">Categories</h2>
                <a class="p-2 border border-[#000] rounded-xl hover:opacity-60" :href="route('categories.create')">
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                    </svg>
                </a>
            </div>

            <div  class="mt-10 " >
                <CategoryData :categories="categories.data" @deleteCategory="deleteCategory" />
                <pagination
                    class="mt-6"
                    :currentPage="currentPage"
                    :maxPages="categories.last_page"
                    @changeCurrentPage="changeCurrentPage"
                />
            </div>
        </div>
    </admin-layout>
</template>

<style scoped>

</style>
