<template>
    <Welcome
        :canLogin="canLogin"
        :canRegister="canRegister"
        :laravelVersion="laravelVersion"
        :phpVersion="phpVersion"
    >
        <div
            class="flex flex-col lg:flex-row justify-between"
        >
            <div class="w-full lg:w-1/3 lg:mr-4 mb-4">
                <ul class="border">
                    <li class="border-b px-6 py-4" @click.prevent="onCategory(0, 'all')">
                        <h4 class="font-semibold text-gray-700 text-xl">
                            Categories
                        </h4>
                    </li>
                    <li
                        class="flex justify-between items-center border-b px-6 py-4 cursor-pointer hover:bg-gray-200"
                        v-for="category in categories"
                        :key="category.id"
                        @click.prevent="onCategory(category.id, category.category_name)"
                    >
                        <span class="text-gray-500 hover:text-gray-100 font-medium">{{ category.category_name }}</span>
                        <!-- <span class="text-gray-500 hover:text-gray-100 font-medium">{{ category.qty }}</span> -->
                    </li>
                </ul>
            </div>
            <Barang v-if="goods.length" :goods="goods" />
            <div v-else class="bg-gray-100 w-full flex justify-center items-center text-4xl text-gray-400 font-bold uppercase">
                Barang Tidak Ada
            </div>
        </div>
    </Welcome>
</template>
<script>
import Barang from "./Barang.vue";
import Welcome from "@/Layouts/Frontend/Welcome.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    components: { Barang, Welcome },
    setup(){
        const form = useForm({
                id: null,
            })
            return { form }
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        goods: Array,
        categories: Object
    },
    mounted(){
        // console.log(this.goods.length)
    },
    methods: {
        onCategory(id, categoryName){
            this.form.id = id
            this.$inertia.get(route("goods", categoryName.replaceAll(" ", "-")))
        },
    }
};
</script>
