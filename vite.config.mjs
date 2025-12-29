import { createViteConfig } from "vite-config-factory";

const entries = {
    'css/modularity-pitea-hero': './source/sass/modularity-pitea-hero.scss',
    'js/modularity-pitea-hero': './source/js/modularity-pitea-hero.js',
};

export default createViteConfig(entries, {
    outDir: "assets/dist",
    manifestFile: "manifest.json",
});

