<template>
    <Head title="Pelelangan" />
    <BreezeAuthenticatedLayout>
        <div class="h-screen flex justify-center items-center">
            <div class="text-center text-6xl text-gray-400"
                >404 | NOT FOUND</div>
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
};
</script>
