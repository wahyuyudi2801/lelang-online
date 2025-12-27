<template>
    <Head title="Tambah Barang" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-end">
                <h1 class="text-2xl text-gray-900 font-semibold">Dashboard</h1>
                <h4 class="text-gray-400 ml-2">Control Panel</h4>
            </div>
            <div class="text-sm font-normal text-gray-800">
                <span>Home</span> /
                <span>auction item&update</span>
            </div>
        </template>
        <div class="my-8">
            <div class="max-w-2xl mx-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-auto shadow-sm sm:rounded">
                    <div class="p-6 bg-white border-t-4 border-gray-400">
                        <h1 class="text-xl font-semibold text-gray-900">
                            Edit Barang
                        </h1>
                        <br />
                        <form @submit.prevent="onSubmit()">
                            <div>
                                <BreezeLabel for="nama" value="Nama Barang" />
                                <BreezeInput
                                    id="nama"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.good_name"
                                    autofocus
                                    autocomplete="on"
                                />
                                <span
                                    v-if="errors.good_name"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error:
                                    {{ errors.good_name }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <label
                                    class="block font-medium text-gray-700"
                                    for="kategori"
                                    >Kategori Barang</label
                                >
                                <select
                                    id="kategori"
                                    v-model="form.category_id"
                                    class="mt-1 text-gray-600 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                >
                                    <option value="" disabled>
                                        --Pilih Kategori--
                                    </option>
                                    <option
                                        v-for="category in categories"
                                        :key="category.id"
                                        :value="category.id"
                                    >
                                        {{ category.category_name }}
                                    </option>
                                </select>
                                <span
                                    v-if="errors.category_id"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error:
                                    {{ errors.category_id }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeLabel
                                    for="keterangan"
                                    value="Keterangan"
                                />
                                <editor
                                    :init="{
                                        menubar: 'edit | format',
                                        plugins: 'lists advlist',
                                        toolbar: [
                                            'undo redo | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent',
                                            'styleselect | bold italic | superscript subscript',
                                        ],
                                        toolbar_mode: 'floating',
                                        height: '400',
                                    }"
                                    v-model="form.description"
                                ></editor>
                                <span
                                    v-if="errors.description"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error:
                                    {{ errors.description }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeLabel
                                    for="tanggalTutup"
                                    value="Tanggal Tutup"
                                />
                                <BreezeInput
                                    id="tanggalTutup"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.closing_date"
                                    autocomplete="on"
                                />
                                <span
                                    v-if="errors.closing_date"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error:
                                    {{ errors.closing_date }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeLabel
                                    for="hargaBuka"
                                    value="Harga Buka"
                                />
                                <BreezeInput
                                    id="hargaBuka"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.open_price"
                                    autocomplete="on"
                                />
                                <span
                                    v-if="errors.open_price"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error:
                                    {{ errors.open_price }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <img
                                    v-if="linkPreview"
                                    :src="linkPreview"
                                    width="200"
                                    class="mb-1 rounded-sm"
                                    :alt="form.url_good"
                                />
                                <img
                                    v-else
                                    :src="'/images/' + form.url_good"
                                    width="200"
                                    class="mb-1 rounded-sm"
                                    :alt="form.url_good"
                                />
                                <BreezeLabel
                                    for="gambar"
                                    value="Input Gambar"
                                />
                                <BreezeInput
                                    id="gambar"
                                    type="file"
                                    class="mt-1 block w-full rounded-sm"
                                    @change.prevent="previewImage"
                                    v-model="wadahValue_img"
                                    accept="image/jpg, image/jpeg, image/png"
                                />
                                <span
                                    v-if="errors.url_good"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error:
                                    {{ errors.url_good }}</span
                                >
                                <span class="text-yellow-500 mt-2 italic"
                                    >*Format JPG/JPEG/PNG</span
                                >
                            </div>

                            <BreezeButton
                                class="mt-4 bg-blue-500 hover:bg-blue-600"
                                :class="{
                                    'bg-blue-300  hover:bg-blue-300 cursor-not-allowed':
                                        form.processing,
                                }"
                                :disabled="form.processing"
                            >
                                Submit
                            </BreezeButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

// import "tinymce";
import "tinymce/tinymce";
import "tinymce/themes/silver";
import "tinymce/icons/default/";
import "tinymce/skins/ui/oxide/skin.min.css";
// import "tinymce/skins/ui/oxide/content.min.css";
// import "tinymce/skins/content/default/content.css";

import "tinymce/plugins/advlist/plugin";
import "tinymce/plugins/lists/plugin";
import Editor from "@tinymce/tinymce-vue";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput,
        BreezeLabel,
        BreezeButton,
        editor: Editor,
    },
    data(props) {
        return {
            linkPreview: null,
            wadahValue_img: null,
            form: useForm(props.good)
        };
    },
    props: {
        good: Object,
        categories: Object,
        errors: Object,
    },
    mounted() {
        // console.log(this.form)
    },
    methods: {
        onSubmit() {
            this.$inertia.post(route("updateBarang", this.good.id), this.form);
        },
        previewImage(e) {
            if(this.wadahValue_img){
                const file = e.target.files[0];
                this.linkPreview = URL.createObjectURL(file);
                this.form.url_good = file;
            }else{
                this.linkPreview = null;
                this.form.url_good = this.good.url_good;
            }
        },
    },
};
</script>
