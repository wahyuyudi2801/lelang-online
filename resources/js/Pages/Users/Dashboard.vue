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
            <div class="bg-blue-600 rounded-sm p-6 relative flex items-center">
                <div class="text-white">
                    <h2 class="text-4xl mb-2 font-semibold">{{ auctions }}</h2>
                    <span>Pelelangan</span>
                </div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="absolute right-2 top-auto p-0 h-3/4 w-auto text-right opacity-20 text-blue-200"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
                    />
                    <path
                        d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"
                    />
                </svg>
            </div>
            <div class="bg-green-600 rounded-sm p-6 relative flex items-center">
                <div class="text-white">
                    <h2 class="text-4xl mb-2 font-semibold">{{ goods }}</h2>
                    <span>Barang</span>
                </div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="absolute right-2 top-auto p-0 h-3/4 w-auto text-right opacity-20 text-green-200"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c.25.112.526.174.818.174.292 0 .569-.062.818-.174L5 10.274zm10 0l-.818 2.552c.25.112.526.174.818.174.292 0 .569-.062.818-.174L15 10.274z"
                        clip-rule="evenodd"
                    />
                </svg>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        goods: Number,
        auctions: Number,
    },
};
</script>
