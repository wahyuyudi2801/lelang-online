require("./bootstrap");
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";

import VueSweetAlert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import axios from "axios";
import VueAxios from "vue-axios";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Auction";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return (
            createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(VueSweetAlert2)
            .use(VueAxios, axios)
            .mixin({ methods: { route } })
            .mount(el)
        );
    },
});

InertiaProgress.init({ color: "#4B5563" });
