<template>
    <Head title="Bid" />

    <Welcome
        :canLogin="canLogin"
        :canRegister="canRegister"
        :laravelVersion="laravelVersion"
        :phpVersion="phpVersion"
    >
        <template #header>
            <h1 class="text-4xl">
                {{ good.good_name }}
            </h1>
        </template>

        <div class="lg:flex lg:justify-between">
            <div class="lg:basis-3/5 mb-4">
                <img
                    :src="'/images/' + good.url_good"
                    width="320"
                    class="block object-contain mx-auto mb-4"
                    :alt="good.url_good"
                />

                <div class="desc mb-4" v-html="good.description" />
                <div>
                    <h1 class="text-4xl text-orange-500 mb-6 font-semibold">
                        Peserta Lelang
                    </h1>
                    <table class="w-full mb-2 text-gray-500">
                        <tr
                            v-if="!auctions.length"
                            class="border-b border-gray-300"
                        >
                            <td colspan="2" class="py-4 text-center">
                                Belum ada kandidat
                            </td>
                        </tr>
                        <tr
                            v-else
                            v-for="(auction, idx) in auctions"
                            :key="auction.id"
                            class="border-b border-gray-300"
                        >
                            <td class="py-4">
                                <span>{{ ++idx }}. {{ auction.candidate }} - [{{ auction.choose ? 'Terpilih' : 'Pending' }}]</span>
                            </td>
                            <td
                                class="py-4 pl-3 text-right font-semibold text-gray-900"
                            >
                                {{ formatPrice(auction.bargain_price) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="md:flex md:justify-between lg:block lg:basis-1/4 mb-4">
                <div class="border text-gray-500 p-5 mb-4">
                    <table class="w-full mb-2">
                        <tr>
                            <td class="py-2">Harga Buka</td>
                            <td
                                class="py-2 pl-3 text-right font-semibold text-gray-900"
                            >
                                {{ formatPrice(good.open_price) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2">Tanggal Tutup</td>
                            <td
                                class="py-2 pl-3 text-right font-semibold text-gray-900"
                            >
                                {{ formatDate(good.closing_date) }}
                            </td>
                        </tr>
                    </table>
                    <form @submit.prevent="onAuction()">
                        <div class="mt-2">
                            <input
                                type="text"
                                class="w-full px-3 py-4 border border-gray-300 block rounded-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                                placeholder="Nama Anda"
                                :disabled="candidateTerpilih"
                                v-model="form.candidate"
                            />
                            <span
                                v-if="errors.candidate"
                                class="italic text-red-500 font-semibold"
                                >{{ errors.candidate }}</span
                            >
                        </div>
                        <div class="mt-2">
                            <input
                                type="tel"
                                class="w-full px-3 py-4 border border-gray-300 block rounded-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                                placeholder="Nomor HP/WA"
                                :disabled="candidateTerpilih"
                                v-model="form.candidate_nomor"
                            />
                            <span
                                v-if="errors.candidate_nomor"
                                class="italic text-red-500 font-semibold"
                                >{{ errors.candidate_nomor }}</span
                            >
                        </div>
                        <div class="mt-2">
                            <input
                                type="number"
                                class="w-full px-3 py-4 border border-gray-300 block rounded-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                                placeholder="Nilai Tawaran"
                                :disabled="candidateTerpilih"
                                v-model="form.bargain_price"
                            />
                            <span
                                v-if="errors.bargain_price"
                                class="italic text-red-500 font-semibold"
                                >{{ errors.bargain_price }}</span
                            >
                        </div>
                        <div class="mt-2">
                            <button
                                type="submit"
                                class="w-full py-3 rounded-sm bg-orange-500 hover:bg-orange-600 text-center text-white focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                                :class="{ 'opacity-50 cursor-not-allowed': candidateTerpilih || form.processing }"
                                :disabled="candidateTerpilih || form.processing"
                            >
                                TAWAR
                            </button>
                            <span
                                v-if="$page.props.flash.message"
                                class="italic text-green-500 font-semibold"
                                >{{ $page.props.flash.message }}</span
                            >
                        </div>
                    </form>
                </div>
                <div
                    class="md:w-1/2 lg:w-full border text-gray-500 py-10 flex flex-col justify-center items-center text-center mb-4"
                >
                    <img
                        v-if="good.url_photo"
                        :src="'/images/users/' + good.url_photo"
                        width="180"
                        class="rounded-full mb-4"
                        :alt="good.url_photo"
                    />
                    <img
                        v-else
                        :src="'/images/lainnya/user.jpg'"
                        width="180"
                        class="rounded-full mb-4"
                        :alt="'user.jpg'"
                    />
                    <h4 class="text-xl text-gray-800 font-semibold">
                        {{ good.name }}
                    </h4>
                    <span class="text-gray-500">Owner</span>
                </div>
            </div>
        </div>
    </Welcome>
</template>
<style>
.desc h1,
.desc h2,
.desc h3,
.desc h4,
.desc h5,
.desc h6 {
    display: block;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
.desc h1 {
    font-size: 2em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
}
.desc h2 {
    font-size: 1.5em;
    margin-top: 0.83em;
    margin-bottom: 0.83em;
}
.desc h3 {
    font-size: 1.17em;
    margin-top: 1em;
    margin-bottom: 1em;
}
.desc h4 {
    font-size: 1em;
    margin-top: 1.33em;
    margin-bottom: 1.33em;
}
.desc h5 {
    font-size: 0.83em;
    margin-top: 1.67em;
    margin-bottom: 1.67em;
}
.desc h6 {
    font-size: 0.67em;
    margin-top: 2.33em;
    margin-bottom: 2.33em;
}
</style>
<script>
import Welcome from "@/Layouts/Frontend/Welcome.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Welcome,
        Head,
    },
    data(props) {
        return {
            form: useForm({
                good_id: props.good.id,
                user_id: props.good.user_id,
                candidate: null,
                candidate_nomor: null,
                bargain_price: null,
                open_price: props.good.open_price,
            }),
        };
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        good: Object,
        auctions: Object,
        pesertaLelang: Object,
        candidateTerpilih: Number,
        errors: Object,
    },
    mounted() {
        // console.log(this.auctions);
        // console.log(this.good);
    },
    methods: {
        onAuction() {
            this.form.post(route("biding"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.candidate = null;
                    this.form.candidate_nomor = null;
                    this.form.bargain_price = null;
                }
            });
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
