<?php

declare(strict_types=1);

namespace ModularityPiteaHero;

use ModularityPiteaHero\Helper\CacheBust;

/**
 * Class App
 * 
 * Main application bootstrap class.
 * Initialize your plugin components here.
 * 
 * @package ModularityPiteaHero
 */
class App
{
    public function __construct()
    {
        // Init subset
        new Admin\Settings();

        // Register module with Modularity
        add_action('init', [$this, 'registerModule']);

        // Enqueue styles
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);
    }

    /**
     * Enqueue styles
     * 
     * @return void
     */
    public function enqueueStyles(): void
    {
        $styleFile = CacheBust::name('css/modularity-pitea-hero.css');

        if ($styleFile) {
            wp_enqueue_style(
                'modularity-pitea-hero',
                MODULARITYPITEAHERO_URL . '/assets/dist/' . $styleFile,
                [],
                null
            );
        }
    }

    /**
     * Register the module with Modularity
     * 
     * @return void
     */
    public function registerModule(): void
    {
        if (function_exists('modularity_register_module')) {
            modularity_register_module(
                MODULARITYPITEAHERO_MODULE_PATH,
                'PiteaHero',
            );
        }
    }
}
