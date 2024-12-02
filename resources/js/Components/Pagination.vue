<template>
    <div v-if="maxPages > 1">
        <div class="flex justify-end -mb-1 my-2">
            <template v-if="currentPage > 1">
                <button
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-[#A19DEC] focus:text-indigo-500"
                    :href="link"
                    preserve-scroll
                    @click="changePage(currentPage - 1)"
                >
                    &lt;&lt;
                </button>
                <button
                    v-if="currentPage > 2"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-[#A19DEC] focus:text-indigo-500"
                    :href="link"
                    preserve-scroll
                    @click="changePage(1)"
                >
                    1
                </button>
                <div
                    v-if="currentPage > 3"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-[#A19DEC] focus:text-indigo-500"
                    :href="link"
                    preserve-scroll
                >
                    ...
                </div>
            </template>
            <template v-for="(link, p) in maxPages" :key="p">
                <button
                    v-if="Math.abs(link - currentPage) <= 1"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-[#A19DEC]"
                    :class="{
                        'border-[#A19DEC]': Number(link) === Number(currentPage),
                    }"
                    :href="link"
                    preserve-scroll
                    @click="changePage(link)"
                >
                    {{ link }}
                </button>
            </template>
            <template v-if="currentPage < maxPages">
                <div
                    v-if="currentPage < maxPages - 2"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-[#A19DEC] focus:text-indigo-500"
                    :href="link"
                    preserve-scroll
                >
                    ...
                </div>
                <button
                    v-if="currentPage < maxPages - 1"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-[#A19DEC] focus:text-indigo-500"
                    :href="link"
                    preserve-scroll
                    @click="changePage(maxPages)"
                >
                    {{ maxPages }}
                </button>
                <button
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-[#A19DEC] focus:text-indigo-500"
                    :href="link"
                    preserve-scroll
                    @click="changePage(currentPage + 1)"
                >
                    &gt;&gt;
                </button>
            </template>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    currentPage: {
        type: Number,
        default: 1,
    },
    maxPages: {
        type: Number,
        default: 1,
    },
});
const emit = defineEmits(["changeCurrentPage"]);
const changePage = (page) => {
    emit("changeCurrentPage", page);
};
</script>
