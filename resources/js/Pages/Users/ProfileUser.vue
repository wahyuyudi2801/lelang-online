<template>
    <Head :title="'Profile ' + $page.props.auth.user.name" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex items-end">
                <h1 class="text-2xl text-gray-900 font-semibold">Dashboard</h1>
                <h4 class="text-gray-400 ml-2">Control Panel</h4>
            </div>
            <div class="text-sm font-normal text-gray-800">
                <span>Home</span> /
                <span>profile</span>
            </div>
        </template>
        <div class="my-8">
            <div class="max-w-2xl mx-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-auto shadow-sm sm:rounded">
                    <div class="p-6 bg-white border-t-4 border-gray-400">
                        <h1 class="text-xl font-semibold text-gray-900 mb-4">
                            Profile
                        </h1>
                        <div
                            class="w-full text-white px-4 py-2 rounded-sm bg-green-500 mb-2"
                            v-if="$page.props.flash.message"
                        >
                            <span>{{ $page.props.flash.message }}</span>
                        </div>
                        <form
                            @submit.prevent="
                                editProfile($page.props.auth.user.id)
                            "
                        >
                            <div
                                class="mt-4 flex flex-col justify-center items-center"
                            >
                                <BreezeLabel
                                    for="gambar"
                                    class="rounded-full overflow-hidden cursor-pointer relative"
                                >
                                    <img
                                        v-if="preview"
                                        :src="preview"
                                        class="block w-64 h-64 object-contain"
                                        alt="profile"
                                    />
                                    <img
                                        v-else-if="form.url_photo"
                                        :src="'/images/users/' + form.url_photo"
                                        class="block w-64 h-64 object-contain"
                                        :alt="form.url_photo"
                                    />
                                    <img
                                        v-else
                                        :src="'/images/lainnya/user.jpg'"
                                        class="block w-64 h-64 object-contain"
                                        alt="profile.jpg"
                                    />
                                    <div
                                        class="absolute top-0 left-0 bg-gray-900 w-full h-full flex justify-center items-center opacity-0 hover:opacity-75 transition ease-in-out delay-150"
                                    >
                                        <svg
                                            class="w-1/4 h-1/4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                                            ></path>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                                            ></path>
                                        </svg>
                                    </div>
                                </BreezeLabel>
                                <BreezeInput
                                    id="gambar"
                                    type="file"
                                    class="hidden"
                                    @change.prevent="previewImage"
                                    v-model="value_img"
                                    accept="image/jpg, image/jpeg, image/png"
                                />
                                <span
                                    class="text-yellow-500 text-left mt-2 italic"
                                >
                                    *Format JPG/JPEG/PNG
                                </span>
                                <span
                                    v-if="errors.photo_url"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error: {{ errors.photo_url }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="name" value="Nama" />
                                <BreezeInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                />
                                <span
                                    v-if="errors.name"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error: {{ errors.name }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="email" value="Email" />
                                <BreezeInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                />
                                <span
                                    v-if="errors.email"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error: {{ errors.email }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <span
                                    class="text-yellow-500 font-semibold text-left mt-2 italic"
                                >
                                    *Ubah password akun Anda dengan mengisi form
                                    password dan konfirmasi password!
                                </span>
                                <BreezeLabel for="password" value="Password" />
                                <BreezeInput
                                    id="password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password"
                                />
                                <span
                                    v-if="errors.password"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error: {{ errors.password }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeLabel
                                    for="password_confirm"
                                    value="Konfirmasi Password"
                                />
                                <BreezeInput
                                    id="password_confirm"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password_confirmation"
                                />
                                <span
                                    v-if="errors.password_confirmation"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error:
                                    {{ errors.password_confirmation }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeLabel
                                    for="nomor_hp"
                                    value="Nomor HP/WA"
                                />
                                <BreezeInput
                                    id="nomor_hp"
                                    type="tel"
                                    class="mt-1 block w-full"
                                    v-model="form.nomor"
                                />
                                <span
                                    v-if="errors.nomor"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error: {{ errors.nomor }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeLabel for="address" value="Alamat" />
                                <textarea
                                    id="address"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    v-model="form.address"
                                ></textarea>
                                <span
                                    v-if="errors.address"
                                    class="block w-full text-gray-100 bg-red-500 px-4 py-2 rounded"
                                    >Error: {{ errors.address }}</span
                                >
                            </div>
                            <div class="mt-4">
                                <BreezeButton
                                    class="bg-blue-500 hover:bg-blue-600"
                                >
                                    Submit
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeInput,
        BreezeLabel,
        BreezeButton,
    },
    props: {
        user: Object,
        errors: Object,
    },
    data() {
        return {
            preview: null,
            value_img: null,
        };
    },
    setup(props) {
        const form = useForm({
            url_photo: props.user.url_photo,
            name: props.user.name,
            email: props.user.email,
            password: "",
            password_confirmation: "",
            nomor: props.user.nomor,
            address: props.user.address,
        });
        return { form };
    },
    methods: {
        reload() {
            this.form.url_photo = this.user.url_photo;
            this.form.name = this.user.name;
            this.form.email = this.user.email;
            this.form.password = "";
            this.form.password_confirmation = "";
            this.form.nomor = this.user.nomor;
            this.form.address = this.user.address;
            this.preview = null;
            this.value_img = null;
        },
        editProfile(id) {
            this.form.post(route("updateProfile", id), {
                preserveScroll: true,
                onSuccess: () => this.reload(),
            });
        },
        previewImage(e) {
            if (this.value_img) {
                const file = e.target.files[0];
                this.preview = URL.createObjectURL(file);
                this.form.url_photo = file;
            } else {
                this.preview = null;
                this.form.url_photo = null;
            }
        },
    },
};
</script>
