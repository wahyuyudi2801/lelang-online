<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-end">
                <h1 class="text-2xl text-gray-900 font-semibold">Dashboard</h1>
                <h4 class="text-gray-400 ml-2">Control Panel</h4>
            </div>
            <div class="text-sm font-normal text-gray-800">
                <span>Home</span> /
                <span>dashboard</span>
            </div>
        </template>

        <div class="p-6 grid grid-cols-4 gap-4">
            <div class="bg-blue-600 rounded-sm p-4 flex justify-between items-center">
                <div class="text-white">
                    <h2 class="text-4xl mb-2 font-semibold">{{ auctions }}</h2>
                    <span>Pelelangan</span>
                </div>
                <div>
                    <span></span>
                </div>
            </div>
            <div class="bg-green-600 rounded-sm p-4 flex justify-between items-center">
                <div class="text-white">
                    <h2 class="text-4xl mb-2 font-semibold">{{ goods }}</h2>
                    <span>Barang</span>
                </div>
                <div>
                    <span></span>
                </div>
            </div>
            <div class="bg-yellow-600 rounded-sm p-4 flex justify-between items-center">
                <div class="text-white">
                    <h2 class="text-4xl mb-2 font-semibold">{{ newUsers }}</h2>
                    <span>Member Baru</span>
                </div>
                <div>
                    <span></span>
                </div>
            </div>
            <div class="bg-red-600 rounded-sm p-4 flex justify-between items-center">
                <div class="text-white">
                    <h2 class="text-4xl mb-2 font-semibold">{{ users }}</h2>
                    <span>Member</span>
                </div>
                <div>
                    <span></span>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedAdmin.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        users: Number,
        newUsers: Number,
        goods: Number,
        auctions: Number,

    },
};
</script>
