<template>
    <admin-layout>
        <div class="max-w-7xl mx-auto  mt-8">
            <div class="flex items-center ">
                <h2 class="text-black">Categories</h2>
            </div>

            <div class="mt-5 w-full">

                <div class="flex  gap-3">
                    <TextInput
                        class="w-full"
                        v-model="category.name"
                        placeholder="Name"
                        label="Name"
                        type="text"
                        id="name"
                        :error="errors.name"
                    />

                    <TextInput
                        class="w-full"
                        v-model="category.slug"
                        placeholder="Slug"
                        label="Slug"
                        type="text"
                        id="slug"
                        :error="errors.slug"
                    />
                </div>
                <div class="flex gap-3">
                    <SelectInput
                        class="w-full"
                        :selected="category.parent_id"
                        :options="categories"
                        v-model="category.parent_id"
                        placeholder="Parent Category"
                        label="Parent Category"
                        id="parent_id"
                        title="category Parent Category"
                    />
                    <FileInput class="w-full" @change="setFile" :error="errors.image"/>
                </div>

                <SuccessButton @click="save">
                    Save
                </SuccessButton>

            </div>
        </div>

        <SuccessModal :show="showSuccessModal" :message="successModalMessage" />
    </admin-layout>
</template>
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import {ref} from "vue";
import SuccessButton from "@/Components/Form/SuccessButton.vue";
import SelectInput from "@/Components/Form/SelectInput.vue";
import FileInput from "@/Components/Form/FileInput.vue";
import SuccessModal from "@/Components/Modal/SuccessModal.vue";

let props = defineProps({
    categories: Array,
    category: Object,
})

const errors = ref({
    name: '',
    slug: '',
})

let showSuccessModal = ref(false);
let successModalMessage = ref('');
let image = ref(null);
const setFile = (e) => {
    image.value.image = e.target.files[0];
}

const validate = () => {
    let check = true;
    errors.value.name = '';
    errors.value.slug = '';
    console.log(props.category);
    if (props.category.name === '') {
        errors.value.name = "Name is required";
        check = false;
    }
    if (props.category.slug === '') {
        errors.value.slug = "slug is required";
        check = false;
    }
    return check;
}
const save = () => {
    if (!validate()) {
        return;
    }
    let formData = new FormData();
    formData.append("name", props.category.name);
    formData.append("slug", props.category.slug);
    if (props.category.parent_id) {
        formData.append("parent_id", props.category.parent_id);
    }
    if (image.value) {
        formData.append("image", image.value);
    }
    axios.patch(route('categories.update',props.category.id), formData,
        { headers: { 'Content-Type': 'application/json' } })
        .then(({data}) => {
            if (data.success) {
                showSuccessModal.value = true;
                successModalMessage.value = data.message;
                setTimeout(() => {
                    showSuccessModal.value = false;
                    location.href="/admin/categories";
                },5000)
            }
        })
        .catch((e) => {
            errors.value = e.response.data.errors;
        })
}
</script>
