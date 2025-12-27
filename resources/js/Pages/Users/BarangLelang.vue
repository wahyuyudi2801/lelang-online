<template>
    <Head title="Barang Lelang" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-end">
                <h1 class="text-2xl text-gray-900 font-semibold">Dashboard</h1>
                <h4 class="text-gray-400 ml-2">Control Panel</h4>
            </div>
            <div class="font-normal text-gray-800">
                <span>Home</span> /
                <span>auction item</span>
            </div>
        </template>
        <div class="my-8">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-auto shadow-sm sm:rounded">
                    <div class="p-6 bg-white border-t-4 border-gray-400">
                        <div class="w-full flex justify-between mb-6">
                            <h1 class="text-3xl font-semibold text-gray-900">
                                Data Barang
                            </h1>
                            <Link
                                :href="route('tambahBarang')"
                                class="flex items-center text-white appearance-none px-6 py-3 capitalize bg-green-600 rounded-sm shadow hover:bg-green-500 hover:text-gray-50 leading-tight focus:outline-none"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 mr-2"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>
                                <span>Tambah</span>
                            </Link>
                        </div>
                        <div class="w-full flex justify-between items-center mb-2">
                            <div class="inline-block relative">
                                <label for="show" class="tracking-wide\"
                                    >Show</label
                                >
                                <select
                                    name="show"
                                    id="show"
                                    v-model="form.show"
                                    @change.prevent="showing()"
                                    class="inline-block appearance-none mx-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none"
                                >
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                                <span class="tracking-wide">entries</span>
                            </div>
                            <div>
                                <label for="search" class="tracking-wide"
                                    >Search</label
                                >
                                <input
                                    type="search"
                                    class="inline-block appearance-none ml-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none"
                                    name="search"
                                    id="search"
                                    v-model="form.search"
                                    @change.prevent="searching()"
                                    placeholder="Enter to searching..."
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                        <div
                            class="w-full text-white px-4 py-2 rounded-sm bg-green-500"
                            v-if="$page.props.flash.message"
                        >
                            <span>{{ $page.props.flash.message }}</span>
                        </div>
                        <table class="border border-gray-200 my-4 w-full">
                            <thead class="bg-gray-50">
                                <tr class="font-semibold text-left">
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>No</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="
                                                listingID('goods.id')
                                            "
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listId.condition !==
                                                            null &&
                                                        listId.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18"
                                                />
                                            </svg>

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listId.condition !==
                                                            null &&
                                                        !listId.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Nama</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="
                                                listingName('goods.good_name')
                                            "
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listName.condition !==
                                                            null &&
                                                        listName.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18"
                                                />
                                            </svg>

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listName.condition !==
                                                            null &&
                                                        !listName.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Kategori</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="
                                                listingCategory(
                                                    'categories.category_name'
                                                )
                                            "
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listCategory.condition !==
                                                            null &&
                                                        listCategory.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18"
                                                />
                                            </svg>

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listCategory.condition !==
                                                            null &&
                                                        !listCategory.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Harga Buka</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="
                                                listingOpenPrice(
                                                    'goods.open_price'
                                                )
                                            "
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listOpenPrice.condition !==
                                                            null &&
                                                        listOpenPrice.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18"
                                                />
                                            </svg>

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listOpenPrice.condition !==
                                                            null &&
                                                        !listOpenPrice.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Tanggal Tutup</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="
                                                listingClosingDate(
                                                    'goods.closing_date'
                                                )
                                            "
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listClosingDate.condition !==
                                                            null &&
                                                        listClosingDate.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18"
                                                />
                                            </svg>

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-3 w-3 inline-block"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    :stroke-width="[
                                                        listClosingDate.condition !==
                                                            null &&
                                                        !listClosingDate.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Gambar</span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="!goods.data.length">
                                <tr>
                                    <td
                                        colspan="6"
                                        class="text-center border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        No data available in table
                                    </td>
                                </tr>
                            </tbody>
                            <tbody
                                v-else
                                v-for="(good, index) in goods.data"
                                :key="good.id"
                            >
                                <tr>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ ++index }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ good.good_name }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ good.category_name }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ formatPrice(good.open_price) }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ formatDate(good.closing_date) }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        <img
                                            :src="'/images/' + good.url_good"
                                            :alt="good.url_good"
                                            width="100"
                                        />
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        <button
                                            class="bg-yellow-500 text-white rounded-sm p-3 hover:bg-yellow-600 hover:text-gray-50"
                                            @click.prevent="Edit(good.id)"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                />
                                            </svg>
                                        </button>
                                        <button
                                            class="bg-red-500 text-white rounded-sm p-3 hover:bg-red-600 hover:text-gray-50"
                                            @click.prevent="Delete(good.id)"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="flex justify-between items-center">
                            <span
                                >Showing {{ goods.data.length ? 1 : 0 }} to
                                {{ goods.data.length }} of
                                {{ form.show }}
                                entries</span
                            >
                            <MyPagination
                                :links="goods.links"
                                :goods="goods"
                                :show="form.show"
                                :search="form.search"
                                :field="form.field"
                                :listing="form.listing"
                                :currentPage="form.currentPage"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import MyPagination from "@/Components/MyPagination.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        MyPagination,
    },
    setup(props) {
        const form = useForm({
            show: props.show,
            search: props.search,
            field: "",
            listing: "",
            currentPage: props.currentPage,
        });
        const listId = useForm({
            condition: null,
        });
        const listName = useForm({
            condition: null,
        });
        const listCategory = useForm({
            condition: null,
        });
        const listOpenPrice = useForm({
            condition: null,
        });
        const listClosingDate = useForm({
            condition: null,
        });
        return {
            form,
            listId,
            listName,
            listCategory,
            listOpenPrice,
            listClosingDate,
        };
    },
    props: {
        goods: Object,
        show: String,
        search: String,
        currentPage: Number,
        message: String,
    },
    mounted() {
        // console.log(this.goods);
    },
    methods: {
        showing() {
            this.$inertia.post(route("auctionItemPost"), this.form);
        },
        searching() {
            this.$inertia.post(route("auctionItemPost"), this.form);
        },
        Edit(id) {
            this.$inertia.get(route("editBarang", id));
        },
        Delete(id) {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route("deleteBarang", id));
                }
            });
        },
        resetList(field) {
            if (field != "goods.id") {
                this.listId.condition = null;
            }
            if (field != "goods.good_name") {
                this.listName.condition = null;
            }
            if (field != "categories.category_name") {
                this.listCategory.condition = null;
            }
            if (field != "goods.open_price") {
                this.listOpenPrice.condition = null;
            }
            if (field != "goods.closing_date") {
                this.listClosingDate.condition = null;
            }
        },
        listingID(id) {
            this.form.field = id;
            this.listId.condition = !this.listId.condition;
            this.form.listing = this.listId.condition ? "asc" : "desc";

            this.resetList(id);
            this.form.post(route("auctionItemPost"));
        },
        listingName(id) {
            this.form.field = id;
            this.listName.condition = !this.listName.condition;
            this.form.listing = this.listName.condition ? "asc" : "desc";

            this.resetList(id);
            this.resetList(id);
            this.form.post(route("auctionItemPost"));
        },
        listingCategory(id) {
            this.form.field = id;
            this.listCategory.condition = !this.listCategory.condition;
            this.form.listing = this.listCategory.condition ? "asc" : "desc";

            this.form.post(route("auctionItemPost"));
            this.resetList(id);
        },
        listingOpenPrice(id) {
            this.form.field = id;
            this.listOpenPrice.condition = !this.listOpenPrice.condition;
            this.form.listing = this.listOpenPrice.condition ? "asc" : "desc";

            this.resetList(id);
            this.form.post(route("auctionItemPost"));
        },
        listingClosingDate(id) {
            this.form.field = id;
            this.listClosingDate.condition = !this.listClosingDate.condition;
            this.form.listing = this.listClosingDate.condition ? "asc" : "desc";

            this.resetList(id);
            this.form.post(route("auctionItemPost"));
        },

        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return (
                "Rp. " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            );
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            // Then specify how you want your dates to be formatted
            return new Intl.DateTimeFormat(["ban", "id"], {
                dateStyle: "long",
            }).format(date);
        },
    },
};
</script>
