<template>
    <Head title="Members" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-end">
                <h1 class="text-2xl text-gray-900 font-semibold">Dashboard</h1>
                <h4 class="text-gray-400 ml-2">Control Panel</h4>
            </div>
            <div class="text-sm font-normal text-gray-800">
                <span>Home</span> /
                <span>members</span>
            </div>
        </template>

        <div class="my-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-auto shadow-sm sm:rounded">
                    <div class="p-6 bg-white border-t-4 border-gray-400">
                        <h1 class="text-xl font-semibold text-gray-900">
                            Data Users
                        </h1>
                        <br />
                        <div class="w-full flex justify-between items-center">
                            <div class="inline-block relative">
                                <label for="show" class="tracking-wide text-sm"
                                    >Show</label
                                >
                                <select
                                    name="show"
                                    id="show"
                                    class="inline-block appearance-none mx-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none"
                                    @change.prevent="getAction()"
                                    v-model="form.paginate"
                                >
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                                <span class="tracking-wide text-sm"
                                    >entries</span
                                >
                            </div>
                            <div>
                                <label
                                    for="search"
                                    class="tracking-wide text-sm"
                                    >Search</label
                                >
                                <input
                                    type="search"
                                    class="inline-block text-sm appearance-none ml-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none"
                                    name="search"
                                    id="search"
                                    placeholder="Enter to searching..."
                                    @change.prevent="getAction()"
                                    v-model="form.search"
                                    autocomplete="off"
                                />
                            </div>
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
                                            @click.prevent="listingId()"
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
                                        <span>Nama User</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="listingName()"
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
                                        <span>Email</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="listingEmail()"
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
                                                        listEmail.condition !==
                                                            null &&
                                                        listEmail.condition
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
                                                        listEmail.condition !==
                                                            null &&
                                                        !listEmail.condition
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
                                        <span>Nomor HP</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="listingNomor()"
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
                                                        listNomor.condition !==
                                                            null &&
                                                        listNomor.condition
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
                                                        listNomor.condition !==
                                                            null &&
                                                        !listNomor.condition
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
                                        <span>Alamat</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="listingAddress()"
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
                                                        listAddress.condition !==
                                                            null &&
                                                        listAddress.condition
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
                                                        listAddress.condition !==
                                                            null &&
                                                        !listAddress.condition
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
                                        <span>Status</span>
                                        <span
                                            class="float-right cursor-pointer"
                                            @click.prevent="listingStatus()"
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
                                                        listStatus.condition !==
                                                            null &&
                                                        listStatus.condition
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
                                                        listStatus.condition !==
                                                            null &&
                                                        !listStatus.condition
                                                            ? '4'
                                                            : '2',
                                                    ]"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                                />
                                            </svg>
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="!users.data.length">
                                <tr>
                                    <td
                                        colspan="6"
                                        class="text-center text-sm border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        No data available in table
                                    </td>
                                </tr>
                            </tbody>
                            <tbody
                                v-else
                                v-for="(user, index) in users.data"
                                :key="user.id"
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
                                        {{ user.name }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ user.email }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ user.nomor }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        {{ user.address }}
                                    </td>
                                    <td
                                        class="border-b border-gray-200 text-gray-500 px-6 py-3"
                                    >
                                        <button
                                            v-if="user.status"
                                            @click.prevent="update(user.id)"
                                            class="border border-green-500 bg-green-600 text-white rounded-sm text-sm px-4 py-2 shadow appearance-none hover:border-green-400 hover:bg-green-500 leading-tight tracking-wide text-sm focus:outline-none"
                                        >
                                            Active
                                        </button>
                                        <button
                                            v-else
                                            @click.prevent="update(user.id)"
                                            class="border border-red-500 bg-red-600 text-white rounded-sm text-sm px-4 py-2 shadow appearance-none hover:border-red-400 hover:bg-red-500 leading-tight tracking-wide text-sm focus:outline-none"
                                        >
                                            Nonactive
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="flex justify-between items-center">
                            <span
                                >Showing {{ users.data.length ? 1 : 0 }} to
                                {{ users.data.length }} of
                                {{ form.paginate }}
                                entries</span
                            >
                            <Pagination
                                :links="users.links"
                                :users="users"
                                :paginate="form.paginate"
                                :search="form.search"
                                :nama="form.nama"
                                :value="form.value"
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
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedAdmin.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Pagination,
    },
    setup(props) {
        const form = useForm({
            paginate: props.paginasi,
            search: props.cari,
            nama: "",
            value: "",
            currentPage: props.halamanSekarang,
        });
        const listName = useForm({
            nama: "name",
            value: "",
            condition: null,
            paginate: "",
            search: "",
        });
        const listId = useForm({
            nama: "id",
            value: "",
            condition: null,
            paginate: "",
            search: "",
        });
        const listEmail = useForm({
            nama: "email",
            value: "",
            condition: null,
            paginate: "",
            search: "",
        });
        const listNomor = useForm({
            nama: "nomor",
            value: "",
            condition: null,
            paginate: "",
            search: "",
        });
        const listAddress = useForm({
            nama: "address",
            value: "",
            condition: null,
            paginate: "",
            search: "",
        });
        const listStatus = useForm({
            nama: "status",
            value: "",
            condition: null,
            paginate: "",
            search: "",
        });
        return { form, listName, listId, listEmail, listNomor, listAddress, listStatus };
    },
    props: {
        users: Object,
        paginasi: String,
        cari: String,
        halamanSekarang: Number,
    },
    mounted() {
        // console.log(this.halamanSekarang)
    },
    methods: {
        getAction() {
            this.form.currentPage = 1;
            this.form.post(route("members"));
        },
        getActionList() {
            this.form.currentPage = this.halamanSekarang;
            this.form.post(route("members"));
            // this.form.post(route("asd"));
        },
        update(id) {
            this.form.paginate = this.paginasi;
            this.form.search = this.cari;
            // this.form.nama = this.form.nama;
            // this.form.value = this.form.value;
            this.form.currentPage = this.halamanSekarang;
            this.form.post(route("members_update", id));
        },
        onReset(nama) {
            if (nama != this.listName.nama) {
                this.listName.condition = null;
                this.listName.value = "";
            }
            if (nama != this.listId.nama) {
                this.listId.condition = null;
                this.listId.value = "";
            }
            if (nama != this.listEmail.nama) {
                this.listEmail.condition = null;
                this.listEmail.value = "";
            }
            if (nama != this.listNomor.nama) {
                this.listNomor.condition = null;
                this.listNomor.value = "";
            }
            if (nama != this.listAddress.nama) {
                this.listAddress.condition = null;
                this.listAddress.value = "";
            }
            if (nama != this.listStatus.nama) {
                this.listStatus.condition = null;
                this.listStatus.value = "";
            }
        },
        listingName() {
            this.listName.condition = !this.listName.condition;
            this.listName.value = this.listName.condition ? "asc" : "desc";

            this.form.nama = this.listName.nama;
            this.form.value = this.listName.value;

            this.getActionList();
            this.onReset(this.listName.nama);
            // console.log(this.users)
        },
        listingId() {
            this.listId.condition = !this.listId.condition;
            this.listId.value = this.listId.condition ? "asc" : "desc";

            // setting form
            this.form.nama = this.listId.nama;
            this.form.value = this.listId.value;

            this.getActionList();
            this.onReset(this.listId.nama);
            // console.log(this.users)
        },
        listingEmail() {
            this.listEmail.condition = !this.listEmail.condition;
            this.listEmail.value = this.listEmail.condition ? "asc" : "desc";

            // setting form
            this.form.nama = this.listEmail.nama;
            this.form.value = this.listEmail.value;

            this.getActionList();
            this.onReset(this.listEmail.nama);
            // console.log(this.users)
        },
        listingNomor() {
            this.listNomor.condition = !this.listNomor.condition;
            this.listNomor.value = this.listNomor.condition ? "asc" : "desc";

            // setting form
            this.form.nama = this.listNomor.nama;
            this.form.value = this.listNomor.value;

            this.getActionList();
            this.onReset(this.listNomor.nama);
            // console.log(this.users)
        },
        listingAddress() {
            this.listAddress.condition = !this.listAddress.condition;
            this.listAddress.value = this.listAddress.condition
                ? "asc"
                : "desc";

            // setting form
            this.form.nama = this.listAddress.nama;
            this.form.value = this.listAddress.value;

            this.getActionList();
            this.onReset(this.listAddress.nama);
            // console.log(this.users)
        },
        listingStatus() {
            this.listStatus.condition = !this.listStatus.condition;
            this.listStatus.value = this.listStatus.condition
                ? "asc"
                : "desc";

            // setting form
            this.form.nama = this.listStatus.nama;
            this.form.value = this.listStatus.value;

            this.getActionList();
            this.onReset(this.listStatus.nama);
            // console.log(this.users)
        },
    },
};
</script>
