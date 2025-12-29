<?php

declare(strict_types=1);

namespace ModularityPiteaHero\Admin;

class Settings
{
    public function __construct()
    {
        add_action('acf/init', [$this, 'registerSettings']);
    }

    /**
     * Register settings
     * @return void
     */
    public function registerSettings(): void
    {
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page([
                'page_title'  => __('modularity-pitea-hero', 'modularity-pitea-hero'),
                'menu_title'  => __('modularity-pitea-hero Settings', 'modularity-pitea-hero'),
                'menu_slug'   => 'modularity-pitea-hero-settings',
                'parent_slug' => 'options-general.php',
                'capability'  => 'manage_options'
            ]);
        }
    }
}
