<?php

/**
 * @brief hermine, a theme for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Themes
 *
 * @copyright Franck Paul (contact@open-time.net)
 * @copyright GPL-2.0
 */
$this->registerModule(
    'Hermine',
    'Hermine photoblog theme (based on Berlin)',
    'Franck Paul',
    '8.2',
    [
        'date'                 => '2026-04-15T17:44:38+0200',
        'requires'             => [['core', '2.36']],
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
