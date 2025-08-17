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
    '7.0',
    [
        'date'                 => '2025-08-17T12:07:33+0200',
        'requires'             => [['core', '2.35']],
        'type'                 => 'theme',
        'tplset'               => 'dotty',
        'widgettitleformat'    => '<h3 class="widget-title">%s</h3>',
        'widgetsubtitleformat' => '<h4 class="widget-subtitle">%s</h4>',
        'overload'             => true,

        'details'    => 'https://open-time.net/?q=hermine',
        'support'    => 'https://github.com/franck-paul/hermine',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/hermine/main/dcstore.xml',
        'license'    => 'gpl2',
    ]
);
