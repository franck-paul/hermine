<?php
/**
 * @brief hermine, a theme for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Themes
 *
 * @copyright Franck Paul (carnet.franck.paul@gmail.com)
 * @copyright GPL-2.0
 */

if (!defined('DC_RC_PATH')) {return;}

$this->registerModule(
    "Hermine",                                   // Name
    "Hermine photoblog theme (based on Berlin)", // Description
    "Franck Paul",                               // Author
    '1.4',                                       // Version
    [
        'requires'    => [['core', '2.13']], // Dependencies
        'type'                 => 'theme',                               // Type
        'tplset'               => 'dotty',                               // tplset
        'widgettitleformat'    => '<h3 class="widget-title">%s</h3>',    // Widget title
        'widgetsubtitleformat' => '<h4 class="widget-subtitle">%s</h4>' // Widget subtitle
    ]
);
