<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <!-- <template v-for="(link, p) in links" :key="p">
                <div
                    v-if="link.url === null && "
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label"
                />
                <div
                    v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-200 focus:border-indigo-500 focus:text-indigo-500"
                    :class="{
                        'bg-blue-700 text-white hover:text-black': link.active,
                    }"
                    v-html="link.label"
                />
            </template> -->
            <!-- Prev -->
            <div
                v-if="form.currentPage > 1"
                class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-200 focus:border-indigo-500 focus:text-indigo-500"
                @click.prevent="onPrevPaginate()"
                v-html="'&laquo; Previous'"
            />
            <div
                v-else
                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                v-html="'&laquo; Previous'"
            />
            <!-- end Prev -->

            <template v-for="(link, p) in links" :key="p">
                <div
                    v-if="link.label >= 0"
                    @click.prevent="onPagination(link.label)"
                    class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-200 focus:border-indigo-500 focus:text-indigo-500"
                    :class="{
                        'bg-blue-700 text-white hover:text-black': link.active,
                    }"
                    v-html="link.label"
                />
            </template>

            <!-- Next -->
            <div
                v-if="form.currentPage < users.last_page"
                class="cursor-pointer mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-200 focus:border-indigo-500 focus:text-indigo-500"
                @click.prevent="onNextPaginate()"
                v-html="'Next &raquo;'"
            />
            <div
                v-else
                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                v-html="'Next &raquo;'"
            />
            <!-- End Next -->
        </div>
    </div>
</template>

<script>
import { Link, useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
    setup(props) {
        const form = useForm({
            paginate: props.paginate,
            search: props.search,
            nama: props.nama,
            value: props.value,
            currentPage: props.currentPage,
        });

        return { form };
    },
    props: {
        links: Array,
        users: Object,
        paginate: String,
        search: String,
        nama: String,
        value: String,
        currentPage: Number,
    },
    mounted() {
        // Halaman reload diakibatkan tag html yang berkategori link
    },
    methods: {
        onDataDefault() {
            this.form.paginate = this.paginate;
            this.form.search = this.search;
            this.form.nama = this.nama;
            this.form.value = this.value;
        },
        onNextPaginate() {
            this.onDataDefault();
            this.form.currentPage += 1;
            this.form.post(route("members"));
        },
        onPagination(label) {
            this.onDataDefault();
            this.form.currentPage = parseInt(label);
            this.form.post(route("members"));
        },
        onPrevPaginate() {
            this.onDataDefault();
            this.form.currentPage -= 1;
            this.form.post(route("members"));
        },
    },
};
</script>
