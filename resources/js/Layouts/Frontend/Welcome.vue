<template>
    <!-- header -->
    <div
        class="bg-logo-image flex justify-center items-center bg-no-repeat bg-cover h-screen relative mb-20"
    >
        <div
            class="absolute top-0 left-0 w-full h-full bg-gray-900 opacity-40 flex"
        ></div>
        <!-- title header -->
        <div
            class="absolute top-0 left-0 w-full h-full flex justify-center items-center"
        >
            <div class="text-center capitalize text-white md:w-1/2">
                <h1 class="text-3xl md:text-5xl mb-2 font-bold">
                    tempat terbaik untuk lelang computer anda!
                </h1>
                <p class="text-gray-100">
                    website pelelangan computer kota/kabupaten pasuruan
                </p>
                <Link
                    v-if="
                        $page.props.auth.user &&
                        $page.props.auth.user.role_id == 1
                    "
                    :href="route('dashboardAdmin')"
                    class="inline-block bg-orange-500 rounded-sm px-8 py-3 my-4 hover:bg-orange-700"
                    >Dashboard</Link
                >
                <Link
                    v-else-if="
                        $page.props.auth.user &&
                        $page.props.auth.user.role_id == 2
                    "
                    :href="route('dashboard')"
                    class="inline-block bg-orange-500 rounded-sm px-8 py-3 my-4 hover:bg-orange-700"
                    >Dashboard</Link
                >
                <Link
                    v-else
                    :href="route('register')"
                    class="inline-block bg-orange-500 rounded-sm px-8 py-3 my-4 hover:bg-orange-700"
                    >Register</Link
                >
            </div>
        </div>
        <!-- end title header -->
        <!-- navbar -->
        <div class="bg-transparent absolute top-0 left-0 w-full h-20 z-10">
            <div
                class="container px-4 mx-auto flex justify-between items-center h-full"
            >
                <div
                    class="flex justify-between md:justify-start items-center w-1/2"
                >
                    <div>
                        <img
                            :src="'../images/lainnya/logo.png'"
                            alt="logo"
                            width="200"
                        />
                    </div>
                    <ul
                        class="lg:flex justify-evenly items-center w-full hidden"
                    >
                        <li>
                            <Link
                                class="text-gray-100 text-lg font-semibold hover:pb-2 hover:border-b-4 hover:border-b-gray-200 hover:text-gray-200"
                                :href="route('home')"
                                >Home</Link
                            >
                        </li>
                        <li>
                            <Link
                                class="text-gray-100 text-lg font-semibold hover:pb-2 hover:border-b-4 hover:border-b-gray-200 hover:text-gray-200"
                                :href="route('goods', 'all')"
                                >Barang</Link
                            >
                        </li>
                        <li>
                            <Link
                                class="text-gray-100 text-lg font-semibold hover:pb-2 hover:border-b-4 hover:border-b-gray-200 hover:text-gray-200"
                                :href="'#'"
                                >Kontak</Link
                            >
                        </li>
                    </ul>
                </div>
                <div
                    v-if="canLogin"
                    class="hidden md:flex justify-between items-center"
                >
                    <Link
                        v-if="
                            $page.props.auth.user &&
                            $page.props.auth.user.role_id == 1
                        "
                        :href="route('dashboardAdmin')"
                        class="bg-orange-500 px-3 py-2 md:px-6 md:py-2 rounded-full text-gray-200 cursor-pointer hover:bg-orange-600 hover:text-gray-100"
                    >
                        Dashboard
                    </Link>
                    <Link
                        v-else-if="
                            $page.props.auth.user &&
                            $page.props.auth.user.role_id == 2
                        "
                        :href="route('dashboard')"
                        class="bg-orange-500 px-3 py-2 md:px-6 md:py-2 rounded-full text-gray-200 cursor-pointer hover:bg-orange-600 hover:text-gray-100"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="bg-orange-500 px-3 py-2 md:px-6 md:py-2 rounded-full text-gray-200 cursor-pointer hover:bg-orange-600 hover:text-gray-100"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="ml-1 md:ml-4 border-2 border-gray-100 px-3 py-2 md:px-6 md:py-2 rounded-full cursor-pointer text-white hover:bg-gray-100 hover:text-black"
                        >
                            Register
                        </Link>
                    </template>
                </div>
                <svg
                    id="open"
                    class="w-16 h-16 block md:ml-6 lg:hidden cursor-pointer"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    @click.prevent="mobileNavbar(true)"
                >
                    <path
                        class="text-white"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    ></path>
                </svg>
            </div>
        </div>
        <!-- end navbar -->
    </div>

    <!-- navbar mobile -->
    <div
        class="fixed top-0 right-ai w-full z-50 block lg:hidden bg-transparent"
        id="mobile"
    >
        <div class="block w-3/4 py-4 h-screen bg-orange-700 float-right">
            <svg
                id="close"
                class="w-14 h-1w-14 float-right mr-4 cursor-pointer"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
                @click.prevent="mobileNavbar(false)"
            >
                <path
                    class="text-white"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                ></path>
            </svg>
            <ul v-if="canLogin" class="w-full flex flex-col md:hidden">
                <hr class="opacity-40" />
                <li
                    class="mt-2 md:hidden"
                    v-if="
                        $page.props.auth.user &&
                        $page.props.auth.user.role_id == 1
                    "
                >
                    <Link
                        :href="route('dashboardAdmin')"
                        class="text-white block px-4 py-2 text-2xl hover:bg-orange-500"
                    >
                        Dashboard
                    </Link>
                </li>
                <li
                    class="mt-2 md:hidden"
                    v-else-if="
                        $page.props.auth.user &&
                        $page.props.auth.user.role_id == 2
                    "
                >
                    <Link
                        :href="route('dashboard')"
                        class="text-white block px-4 py-2 text-2xl hover:bg-orange-500"
                    >
                        Dashboard
                    </Link>
                </li>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="text-white block px-4 py-2 text-2xl hover:bg-orange-500"
                    >
                        Log in
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="text-white block px-4 py-2 text-2xl hover:bg-orange-500"
                    >
                        Register
                    </Link>
                </template>
            </ul>
            <ul class="w-full flex flex-col">
                <hr class="opacity-40" />
                <li class="mt-2">
                    <Link
                        class="text-white block px-4 py-2 text-2xl hover:bg-orange-500"
                        :href="route('home')"
                        >Home</Link
                    >
                </li>
                <li class="mt-2">
                    <Link
                        class="text-white block px-4 py-2 text-2xl hover:bg-orange-500"
                        :href="route('goods', 'all')"
                        >Barang</Link
                    >
                </li>
                <li class="mt-2">
                    <Link
                        class="text-white block px-4 py-2 text-2xl hover:bg-orange-500"
                        :href="'#'"
                        >Contact</Link
                    >
                </li>
            </ul>
        </div>
    </div>
    <!-- end navbar mobile -->
    <!-- end header -->
    <header class="text-center mb-20" v-if="$slots.header">
        <slot name="header" />
    </header>
    <main class="container px-4 mx-auto">
        <slot />
    </main>
    <Footer />
</template>

<style>
/* totok kene */
.right-ai {
    right: -100%;
    transition: ease 0.6s;
}
</style>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Footer from "./Footer.vue";

export default {
    components: {
        Head,
        Link,
        Footer,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    methods: {
        mobileNavbar(params) {
            const mobile = document.getElementById("mobile");
            params
                ? (mobile.style.right = "0")
                : (mobile.style.right = "-100%");
        },
    },
};
</script>
