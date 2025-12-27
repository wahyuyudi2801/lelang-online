<template>
    <div
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 sm:grid-cols-1 gap-8 container mx-auto"
    >
        <div v-for="item in goods" :key="item.id">
            <div class="flex justify-center h-64 bg-transparent overflow-hidden">
                <img :src="'/images/' + item.url_good" class="object-cover" :alt="item.url_good" />
            </div>
            <div class="m-10">
                <h4 class="font-bold text-xl capitalize mb-4">
                    {{ item.good_name }}
                </h4>
                <div
                    class="flex justify-between items-center mb-2 text-gray-400"
                >
                    <span>{{ item.category_name }}</span>
                    <span>{{ formatPrice(item.open_price) }}</span>
                </div>
                <button
                    class="inline-block bg-orange-500 text-white px-8 py-3 rounded-sm hover:bg-orange-700"
                    @click.prevent="onRouteBid(item.id, item.good_name)"
                >
                    Input Penawaran
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { Link, useForm } from '@inertiajs/inertia-vue3'
export default {
    components: {
        Link
    },
    // data(){
    //     return{
    //         form: useForm({
    //             id: null
    //         })
    //     }
    // },
    props: {
        goods: Object,
        categoryID: Number
    },
    mounted(){
        // console.log(this.anjay)
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return (
                "Rp. " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            );
        },
        onRouteBid(id, name){
            // this.form.id = id
            this.$inertia.get(route("bid", id))
        }
    }
}
</script>
