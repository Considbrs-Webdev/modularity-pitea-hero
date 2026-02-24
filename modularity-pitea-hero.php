<?php

/**
 * Plugin Name:       Modularity Pitea Hero
 * Plugin URI:        https://github.com/Considbrs-Webdev/modularity-pitea-hero
 * Description:       A module for the Pitea Hero.
 * Version:           1.0.0
 * Author:            Consid Borås AB
 * Author URI:        https://github.com/Considbrs-Webdev
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       modularity-pitea-hero
 * Domain Path:       /languages
 */

// Protect against direct file access
if (! defined('WPINC')) {
    die;
}

define('MODULARITYPITEAHERO_PATH', plugin_dir_path(__FILE__));
define('MODULARITYPITEAHERO_URL', plugins_url('', __FILE__));
define('MODULARITYPITEAHERO_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('MODULARITYPITEAHERO_MODULE_PATH', MODULARITYPITEAHERO_PATH . 'source/php/Module/');

// Load text domain early (before acf/init) so PHP ACF field labels translate
add_action('plugins_loaded', function () {
    load_plugin_textdomain('modularity-pitea-hero', false, plugin_basename(dirname(__FILE__)) . '/languages');
});

// Autoload from plugin
if (file_exists(MODULARITYPITEAHERO_PATH . 'vendor/autoload.php')) {
    require_once MODULARITYPITEAHERO_PATH . 'vendor/autoload.php';
}

// ACF auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-pitea-hero');
    $acfExportManager->setExportFolder(MODULARITYPITEAHERO_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'pitea-hero-module' => 'group_pitea_hero_module',
    ));
    $acfExportManager->import();
});

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-pitea-hero'] = MODULARITYPITEAHERO_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new ModularityPiteaHero\App();
