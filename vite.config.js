import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "public/js/fastbootstrap.min.js",
                "resources/js/app.js",
                "resources/css/app.css",
                "public/css/choices.min.css",
                "public/css/fastbootstrap.min.css",
            ],
            refresh: true,
        }),
    ],
});
