<?php

namespace ModularityPiteaHero\Module;

use ModularityPiteaHero\Helper\CacheBust;

/**
 * Class PiteaHero
 * @package PiteaHero\Module
 */
class PiteaHero extends \Modularity\Module
{
    public $slug = 'pitea-hero';
    public $supports = array();

    public function init()
    {
        $this->nameSingular = __("PiteaHero", 'modularity-pitea-hero');
        $this->namePlural = __("PiteaHero", 'modularity-pitea-hero');
        $this->description = __("A module for the Pitea Hero.", 'modularity-pitea-hero');
    }

    /**
     * Data array
     * @return array $data
     */
    public function data(): array
    {
        $data = array();
        $fieldNamespace = 'mod_piteahero_';

        // Get hide title field (standard Modularity field)
        $data['hideTitle'] = (bool) get_field('mod_hide_title', $this->ID);

        // Get basic fields
        $data['backgroundImage'] = get_field($fieldNamespace . 'background_image', $this->ID);
        $data['heading'] = get_field($fieldNamespace . 'heading', $this->ID);
        $data['searchPlaceholder'] = get_field($fieldNamespace . 'search_placeholder', $this->ID);

        // Get buttons repeater
        $buttons = get_field($fieldNamespace . 'buttons', $this->ID);
        $data['buttons'] = array();

        if (!empty($buttons) && is_array($buttons)) {
            foreach ($buttons as $button) {
                $buttonData = array(
                    'icon' => isset($button[$fieldNamespace . 'button_icon']) ? $button[$fieldNamespace . 'button_icon'] : '',
                    'text' => isset($button[$fieldNamespace . 'button_text']) ? $button[$fieldNamespace . 'button_text'] : '',
                    'link' => isset($button[$fieldNamespace . 'button_link']) ? $button[$fieldNamespace . 'button_link'] : array(),
                );

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
        return "pitea-hero.blade.php";
    }

    /**
     * Style - Register & adding css
     * @return void
     */
    public function style()
    {
        //Register custom css
        wp_register_style(
            'modularity-pitea-hero',
            MODULARITY_PITEA_HERO_URL . '/dist/' . CacheBust::name('css/modularity-pitea-hero.css'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_style('modularity-pitea-hero');
    }

    /**
     * Script - Register & adding scripts
     * @return void
     */
    public function script()
    {
        //Register custom css
        wp_register_script(
            'modularity-pitea-hero',
            MODULARITY_PITEA_HERO_URL . '/dist/' . CacheBust::name('js/modularity-pitea-hero.js'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_script('modularity-pitea-hero');
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
