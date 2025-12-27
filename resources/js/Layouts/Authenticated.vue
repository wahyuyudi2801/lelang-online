<template>
    <div class="relative">
        <!-- sidebar -->
        <div class="fixed left-0 top-0 h-screen bg-gray-800 w-side">
            <div
                class="h-16 py-4 text-center text-gray-100 text-lg bg-blue-700"
            >
                <Link :href="route('dashboard')" class="hover:text-gray-300"
                    ><span class="font-bold">ADMIN</span>DASH</Link
                >
            </div>
            <div class="flex justify-start items-center p-4">
                <div>
                    <img
                        v-if="$page.props.auth.user.url_photo"
                        :src="'/images/users/' + $page.props.auth.user.url_photo"
                        :alt="$page.props.auth.user.url_photo"
                        class="w-12 rounded-full"
                    />
                    <img
                        v-else
                        :src="'/images/lainnya/user.jpg'"
                        alt="user.jpg"
                        class="w-12 rounded-full"
                    />
                </div>
                <div class="text-gray-100 ml-3">
                    <h5 class="font-semibold">{{ $page.props.auth.user.name }}</h5>
                    <div class="flex items-center">
                        <span class="greenball"></span>
                        <span class="font-normal text-sm">Online</span>
                    </div>
                </div>
            </div>
            <div class="text-gray-50">
                <h6 class="bg-gray-900 px-4 py-2 text-gray-600 font-semibold">
                    MAIN NAVIGATION
                </h6>
                <ul>
                    <li class="font-normal text-gray-200 mt-2">
                        <Link
                            class="flex items-center px-8 py-3 hover:bg-gray-900 w-full h-full"
                            :href="route('dashboard')"
                            ><svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                                />
                            </svg>
                            <span>Dashboard</span>
                        </Link>
                    </li>
                    <li class="font-normal text-gray-200 mt-2">
                        <Link
                            class="flex items-center px-8 py-3 hover:bg-gray-900 w-full h-full"
                            :href="route('auctionItem')"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
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
                            <span>Barang</span></Link
                        >
                    </li>
                    <li class="font-normal text-gray-200 mt-2">
                        <Link
                            class="flex items-center px-8 py-3 hover:bg-gray-900 w-full h-full"
                            :href="route('auctions')"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c.25.112.526.174.818.174.292 0 .569-.062.818-.174L5 10.274zm10 0l-.818 2.552c.25.112.526.174.818.174.292 0 .569-.062.818-.174L15 10.274z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span>Lelang</span></Link
                        >
                    </li>
                </ul>
            </div>
        </div>
        <!-- end sidebar -->

        <div class="w-nav float-right bg-gray-100 min-h-screen">
            <!-- navbar -->
            <nav
                class="sticky top-0 z-50 w-full sm:px-6 lg:px-8 py-4 h-16 flex justify-between items-center text-gray-100 text-lg bg-blue-600"
            >
                <!-- left -->
                <div>
                    <svg
                        id="open"
                        class="w-8 h-8 cursor-pointer"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        @click.prevent="animate()"
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

                <!-- right -->
                <div class="flex justify-between items-center">
                    <img
                        v-if="$page.props.auth.user.url_photo"
                        :src="'/images/users/' + $page.props.auth.user.url_photo"
                        :alt="$page.props.auth.user.url_photo"
                        class="w-10 rounded-full block"
                    />
                    <img
                        v-else
                        :src="'/images/lainnya/user.jpg'"
                        alt="user.jpg"
                        class="w-10 rounded-full block"
                    />
                    <BreezeDropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex">
                                <button
                                    type="button"
                                    class="inline-flex capitalize items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md text-gray-50 bg-transparent hover:text-gray-100 focus:outline-none transition ease-in-out duration-150"
                                >
                                    {{ $page.props.auth.user.name }}

                                    <svg
                                        class="ml-2 -mr-0.5 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <BreezeDropdownLink
                                :href="route('profile', $page.props.auth.user.id)"
                                method="get"
                                as="button"
                            >
                                <svg class="w-6 h-6 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Profile
                            </BreezeDropdownLink>
                            <BreezeDropdownLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                <svg class="w-6 h-6 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg> Log Out
                            </BreezeDropdownLink>
                        </template>
                    </BreezeDropdown>
                </div>
            </nav>
            <!-- end navbar -->

            <!-- header -->
            <header
                class="flex sm:px-6 lg:px-8 py-4 justify-between items-center"
                v-if="$slots.header"
            >
                <slot name="header" />
            </header>
            <!-- end header -->

            <!-- main -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<style>
.greenball {
    display: block;
    width: 12px;
    height: 12px;
    background: rgb(19, 223, 19);
    border-radius: 100%;
    margin-right: 5px;
}
.w-side {
    width: 18%;
    overflow: hidden;
    transition: ease 0.5s;
}
.w-side.hide {
    width: 0%;
    opacity: 0;
}
.w-nav {
    width: 82%;
    transition: ease 0.5s;
}
.w-nav.hide {
    width: 100%;
}
</style>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
    methods: {
        animate() {
            var sidebar = document.getElementsByClassName("w-side")[0];
            var navbar = document.getElementsByClassName("w-nav")[0];
            sidebar.classList.toggle("hide");
            navbar.classList.toggle("hide");
        },
    },
};
</script>
