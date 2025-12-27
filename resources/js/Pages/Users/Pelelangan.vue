<template>
    <Head title="Pelelangan" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-end">
                <h1 class="text-2xl text-gray-900 font-semibold">Dashboard</h1>
                <h4 class="text-gray-400 ml-2">Control Panel</h4>
            </div>
            <div class="font-normal text-gray-800">
                <span>Home</span> /
                <span>auctions</span>
            </div>
        </template>

        <div class="my-8">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-auto shadow-sm sm:rounded">
                    <div class="p-6 bg-white border-t-4 border-gray-400">
                        <div class="flex justify-between items-center">
                            <h1
                                class="text-3xl font-semibold text-gray-900 mb-6"
                            >
                                Data Lelang
                            </h1>
                            <select
                                v-model="form.category_id"
                                @change.prevent="getAuction()"
                                class="mt-1 text-gray-600 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            >
                                <option value="" disabled>
                                    --Pilih Barang Dulu--
                                </option>
                                <option
                                    v-for="good in goods"
                                    :key="good.id"
                                    :value="good.id"
                                >
                                    {{ good.good_name }}
                                </option>
                            </select>
                        </div>
                        <div class="w-full flex justify-between items-center">
                            <div class="inline-block relative">
                                <label for="show" class="tracking-wide\"
                                    >Show</label
                                >
                                <select
                                    id="show"
                                    class="inline-block appearance-none mx-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none"
                                    v-model="form.show"
                                    @change.prevent="getAuction()"
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
                                    v-model="form.search"
                                    @change.prevent="getAuction()"
                                    placeholder="Enter to searching..."
                                />
                            </div>
                        </div>
                        <div
                            class="w-full text-white px-4 py-2 rounded-sm bg-green-500 mt-4"
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
                                            @click.prevent="listingID('auctions.id')"
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
                                                    :stroke-width="[listID.condition !== null && listID.condition ? '4' : '2']"
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
                                                    :stroke-width="[listID.condition !== null && !listID.condition ? '4' : '2']"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                        @click.prevent="listingCandidate('auctions.candidate')"
                                    >
                                        <span>Kandidat</span>
                                        <span
                                            class="float-right cursor-pointer"
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
                                                    :stroke-width="[listCandidate.condition !== null && listCandidate.condition ? '4' : '2']"
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
                                                    :stroke-width="[listCandidate.condition !== null && !listCandidate.condition ? '4' : '2']"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Barang</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="listingGoodName('goods.good_name')"
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
                                                    :stroke-width="[listGoodName.condition !== null && listGoodName.condition ? '4' : '2']"
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
                                                    :stroke-width="[listGoodName.condition !== null && !listGoodName.condition ? '4' : '2']"
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
                                            @click.prevent="listingOpenPrice('goods.open_price')"
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
                                                    :stroke-width="[listOpenPrice.condition !== null && listOpenPrice.condition ? '4' : '2']"
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
                                                    :stroke-width="[listOpenPrice.condition !== null && !listOpenPrice.condition ? '4' : '2']"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Harga Tawar</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="listingBargainPrice('auctions.bargain_price')"
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
                                                    :stroke-width="[listBargainPrice.condition !== null && listBargainPrice.condition ? '4' : '2']"
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
                                                    :stroke-width="[listBargainPrice.condition !== null && !listBargainPrice.condition ? '4' : '2']"
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
                                            @click.prevent="listingClosingDate('goods.closing_date')"
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
                                                    :stroke-width="[listClosingDate.condition !== null && listClosingDate.condition ? '4' : '2']"
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
                                                    :stroke-width="[listClosingDate.condition !== null && !listClosingDate.condition ? '4' : '2']"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Status</span>
                                    </th>
                                    <th
                                        class="border-b border-gray-200 text-gray-700 px-6 py-3"
                                    >
                                        <span>Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!auctions.total">
                                    <td
                                        colspan="8"
                                        class="text-center border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        No data available in table
                                    </td>
                                </tr>
                                <tr
                                    v-else
                                    v-for="(auction, idx) in auctions.data"
                                    :key="auction.id"
                                >
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ ++idx }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ auction.candidate }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ auction.good_name }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ formatPrice(auction.open_price) }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ formatPrice(auction.bargain_price) }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ formatDate(auction.closing_date) }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        <div
                                            class="text-white text-center text-sm rounded-full px-2 py-1"
                                            :class="[
                                                auction.choose
                                                    ? 'bg-green-500'
                                                    : 'bg-red-500',
                                            ]"
                                        >
                                            {{
                                                auction.choose
                                                    ? "Terpilih"
                                                    : "Pending"
                                            }}
                                        </div>
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        <button
                                            @click.prevent="pilih(auction.id)"
                                            :disabled="
                                                candidateTerpilih &&
                                                !auction.choose
                                            "
                                            :class="{
                                                'bg-red-500': auction.choose,
                                                'bg-blue-500': !auction.choose,
                                                'opacity-50':
                                                    candidateTerpilih &&
                                                    !auction.choose,
                                            }"
                                            class="text-white text-sm px-3 py-2 rounded"
                                        >
                                            {{
                                                auction.choose
                                                    ? "Batalkan"
                                                    : "Pilih"
                                            }}
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="flex justify-between items-center" v-if="auctions.total">
                            <span
                                >Showing {{ auctions.data.length ? 1 : 0 }} to
                                {{ auctions.data.length ? auctions.data.length : 0 }} of
                                {{ form.show }}
                                entries</span
                            >
                            <AuctionPagination
                                :links="auctions.links"
                                :auctions="auctions"
                                :categoryID="form.category_id"
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
import AuctionPagination from "@/Components/AuctionPagination.vue"
import { Head, useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        AuctionPagination
    },
    setup(props) {
        const form = useForm({
            category_id: props.goodID,
            show: props.show,
            search: props.search,
            field: "",
            listing: "",
            currentPage: props.currentPage,
        });
        const listID = useForm({
            condition: null
        });
        const listCandidate = useForm({
            condition: null
        });
        const listGoodName = useForm({
            condition: null
        });
        const listOpenPrice = useForm({
            condition: null
        });
        const listBargainPrice = useForm({
            condition: null
        });
        const listClosingDate = useForm({
            condition: null
        });
        return { form, listID, listCandidate, listGoodName, listOpenPrice, listBargainPrice, listClosingDate };
    },
    props: {
        goods: Object,
        goodID: String,
        auctions: Object,
        candidateTerpilih: Number,
        show: String,
        search: String,
        currentPage: Number
    },
    mounted() {
        // console.log(this.auctions)
    },
    methods: {
        getAuction() {
            this.$inertia.post(route("auctions.show"), this.form);
        },
        pilih(param) {
            this.$inertia.post(route("auctions.update", param), this.form);
        },
        resetList(id){
            if(id != "auctions.id") this.listID.condition = null
            if(id != "auctions.candidate") this.listCandidate.condition = null
            if(id != "goods.good_name") this.listGoodName.condition = null
            if(id != "goods.open_price") this.listOpenPrice.condition = null
            if(id != "auctions.bargain_price") this.listBargainPrice.condition = null
            if(id != "goods.closing_date") this.listClosingDate.condition = null
        },
        listingID(id){
            this.form.field = id;
            this.listID.condition = !this.listID.condition;
            this.form.listing = this.listID.condition ? "asc" : "desc";

            this.resetList(id);
            this.$inertia.post(route("auctions.show"), this.form);
        },
        listingCandidate(id){
            this.form.field = id;
            this.listCandidate.condition = !this.listCandidate.condition;
            this.form.listing = this.listCandidate.condition ? "asc" : "desc";

            this.resetList(id);
            this.$inertia.post(route("auctions.show"), this.form);
        },
        listingGoodName(id){
            this.form.field = id;
            this.listGoodName.condition = !this.listGoodName.condition;
            this.form.listing = this.listGoodName.condition ? "asc" : "desc";

            this.resetList(id);
            // this.$inertia.post(route("auctions.show"), this.form);
        },
        listingOpenPrice(id){
            this.form.field = id;
            this.listOpenPrice.condition = !this.listOpenPrice.condition;
            this.form.listing = this.listOpenPrice.condition ? "asc" : "desc";

            this.resetList(id);
            // this.$inertia.post(route("auctions.show"), this.form);
        },
        listingBargainPrice(id){
            this.form.field = id;
            this.listBargainPrice.condition = !this.listBargainPrice.condition;
            this.form.listing = this.listBargainPrice.condition ? "desc" : "asc";

            this.resetList(id);
            this.$inertia.post(route("auctions.show"), this.form);
        },
        listingClosingDate(id){
            this.form.field = id;
            this.listClosingDate.condition = !this.listClosingDate.condition;
            this.form.listing = this.listClosingDate.condition ? "desc" : "asc";

            this.resetList(id);
            this.$inertia.post(route("auctions.show"), this.form);
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
