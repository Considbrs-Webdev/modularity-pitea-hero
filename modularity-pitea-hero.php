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

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('MODULARITY_PITEA_HERO_PATH', plugin_dir_path(__FILE__));
define('MODULARITY_PITEA_HERO_URL', plugins_url('', __FILE__));
define('MODULARITY_PITEA_HERO_TEMPLATE_PATH', MODULARITY_PITEA_HERO_PATH . 'templates/');
define('MODULARITY_PITEA_HERO_VIEW_PATH', MODULARITY_PITEA_HERO_PATH . 'views/');
define('MODULARITY_PITEA_HERO_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('MODULARITY_PITEA_HERO_MODULE_PATH', MODULARITY_PITEA_HERO_PATH . 'source/php/Module/');

load_plugin_textdomain('modularity-pitea-hero', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once MODULARITY_PITEA_HERO_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once MODULARITY_PITEA_HERO_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new ModularityPiteaHero\Vendor\Psr4ClassLoader();
$loader->addPrefix('ModularityPiteaHero', MODULARITY_PITEA_HERO_PATH);
$loader->addPrefix('ModularityPiteaHero', MODULARITY_PITEA_HERO_PATH . 'source/php/');
$loader->register();

// Include ACF field groups
if (file_exists(MODULARITY_PITEA_HERO_PATH . 'source/php/AcfFields/php/pitea-hero-module.php')) {
    require_once MODULARITY_PITEA_HERO_PATH . 'source/php/AcfFields/php/pitea-hero-module.php';
}

// Acf auto import and export
add_action('plugins_loaded', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-pitea-hero');
    $acfExportManager->setExportFolder(MODULARITY_PITEA_HERO_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'pitea-hero-module' => 'group_pitea_hero_module'
    ));
    $acfExportManager->import();
});


// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-pitea-hero'] = MODULARITY_PITEA_HERO_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new ModularityPiteaHero\App();
