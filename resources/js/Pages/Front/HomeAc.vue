<template>
    <Head title="Home" />
    <Welcome
        :canLogin="canLogin"
        :canRegister="canRegister"
        :laravelVersion="laravelVersion"
        :phpVersion="phpVersion"
    >
        <template #header>
            <p class="text-gray-500 line-spacing font-semibold">LELANG</p>
            <h1 class="text-4xl">
                Daftar <span class="font-semibold">Lelang</span>
            </h1>
        </template>

        <Barang :goods="goods" />
    </Welcome>
</template>
<style>
.line-spacing {
    letter-spacing: 6px;
}
</style>
<script>
import Welcome from "@/Layouts/Frontend/Welcome.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Barang from "./Barang.vue";

export default {
    components: {
        Barang,
        Welcome,
        Head,
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        goods: Object,
    },
};
</script>
