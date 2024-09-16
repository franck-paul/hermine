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
$this->registerModule(
    'Hermine',
    'Hermine photoblog theme (based on Berlin)',
    'Franck Paul',
    '5.0',
    [
        'requires'             => [['core', '2.28']],
        'type'                 => 'theme',
        'tplset'               => 'dotty',
        'widgettitleformat'    => '<h3 class="widget-title">%s</h3>',
        'widgetsubtitleformat' => '<h4 class="widget-subtitle">%s</h4>',

        'details'    => 'https://open-time.net/?q=hermine',
        'support'    => 'https://github.com/franck-paul/hermine',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/hermine/main/dcstore.xml',
    ]
);
