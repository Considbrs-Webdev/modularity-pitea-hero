<?php

declare(strict_types=1);

namespace ModularityPiteaHero\Module;

use ModularityPiteaHero\Helper\CacheBust;

/**
 * Class PiteaHero
 * @package ModularityPiteaHero\Module
 */
class PiteaHero extends \Modularity\Module
{
    public $slug = 'pitea-hero';
    public $supports = [];

    public function init(): void
    {
        $this->nameSingular = __('Piteå Hero', 'modularity-pitea-hero');
        $this->namePlural = __('Piteå Hero', 'modularity-pitea-hero');
        $this->description = __('A module for the Piteå Hero.', 'modularity-pitea-hero');
    }

    /**
     * Data array
     * @return array $data
     */
    public function data(): array
    {
        $data = [];

        // Append field config
        $data = array_merge($data, (array) \Modularity\Helper\FormatObject::camelCase(
            $this->getFields(),
        ));

        $fieldNamespace = 'mod_piteahero_';

        // Get basic fields
        $data['backgroundImage'] = get_field($fieldNamespace . 'background_image', $this->ID);
        $data['overlayOpacity'] = get_field($fieldNamespace . 'overlay_opacity', $this->ID);
        $data['heading'] = get_field($fieldNamespace . 'heading', $this->ID);
        $data['searchPlaceholder'] = get_field($fieldNamespace . 'search_placeholder', $this->ID);
        $data['searchUrl'] = apply_filters('Modularity/PiteaHero/SearchUrl', home_url('/'));
        // Get buttons repeater

        $buttons = get_field($fieldNamespace . 'buttons', $this->ID);
        $data['buttons'] = [];

        if (!empty($buttons) && is_array($buttons)) {
            foreach ($buttons as $button) {
                $buttonData = [
                    'icon' => isset($button[$fieldNamespace . 'button_icon']) ? $button[$fieldNamespace . 'button_icon'] : '',
                    'text' => isset($button[$fieldNamespace . 'button_text']) ? $button[$fieldNamespace . 'button_text'] : '',
                    'link' => isset($button[$fieldNamespace . 'button_link']) ? $button[$fieldNamespace . 'button_link'] : [],
                ];

                // Format link field (ACF link returns array with url, title, target)
                if (!empty($buttonData['link']) && is_array($buttonData['link'])) {
                    $buttonData['url'] = isset($buttonData['link']['url']) ? $buttonData['link']['url'] : '';
                    $buttonData['title'] = isset($buttonData['link']['title']) ? $buttonData['link']['title'] : '';
                    $buttonData['target'] = isset($buttonData['link']['target']) ? $buttonData['link']['target'] : '';
                } else {
                    $buttonData['url'] = '';
                    $buttonData['title'] = '';
                    $buttonData['target'] = '';
                }

                // Format as object for Blade template
                $data['buttons'][] = (object) $buttonData;
            }
        }

        return $data;
    }

    /**
     * Blade Template
     * @return string
     */
    public function template(): string
    {
        return 'pitea-hero.blade.php';
    }

    /**
     * Style - Register & adding css
     * @return void
     */
    public function style(): void
    {
        $this->wpEnqueue?->add('css/modularity-pitea-hero.css', [], '1.0.0');
    }

    /**
     * Script - Register & adding js
     * @return void
     */
    public function script(): void
    {
        $scriptFile = CacheBust::name('js/modularity-pitea-hero.js');

        if ($scriptFile) {
            wp_enqueue_script(
                'modularity-pitea-hero',
                MODULARITYPITEAHERO_URL . '/assets/dist/' . $scriptFile,
                [],
                null,
                true
            );
        }
    }

    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}
