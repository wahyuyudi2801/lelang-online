<template>
    <div class="relative">
        <!-- sidebar -->
        <div class="fixed left-0 top-0 h-screen bg-gray-800 w-side">
            <div
                class="h-16 py-4 text-center text-gray-100 text-lg bg-blue-700"
            >
                <Link :href="route('dashboardAdmin')" class="hover:text-gray-300"
                    ><span class="font-bold">ADMIN</span>DASH</Link
                >
            </div>
            <div class="flex justify-start items-center p-4">
                <div>
                    <img
                        :src="'./images/lainnya/profil.jpg'"
                        alt="profile"
                        class="w-12 rounded-full"
                    />
                </div>
                <div class="text-gray-100 ml-3">
                    <h5 class="font-semibold">Administrator</h5>
                    <div class="flex items-center">
                        <span class="greenball"></span>
                        <span class="font-normal text-sm">Online</span>
                    </div>
                </div>
            </div>
            <div class="text-gray-50">
                <h6
                    class="bg-gray-900 px-4 py-2 text-gray-600 font-semibold"
                >
                    MAIN NAVIGATION
                </h6>
                <ul>
                    <li class="font-normal text-gray-200 mt-2">
                        <Link
                            class="px-8 py-3 inline-block hover:bg-gray-900 w-full h-full"
                            :href="route('dashboardAdmin')"
                            >Dashboard</Link>
                    </li>
                    <li class="font-normal text-gray-200 mt-2">
                        <Link
                            class="px-8 py-3 inline-block hover:bg-gray-900 w-full h-full"
                            :href="route('members')"
                            >Members</Link>
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
                        :src="'./images/lainnya/profil.jpg'"
                        alt="profile"
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
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </BreezeDropdownLink>
                        </template>
                    </BreezeDropdown>
                    <!-- Settings Dropdown -->
                    <!-- <div class="ml-3 relative">

                            </div> -->
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
    width: 20%;
    overflow: hidden;
    transition: ease 0.5s;
}
.w-side.hide {
    width: 0%;
    opacity: 0;
}
.w-nav {
    width: 80%;
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
