<?php
/**
 * @brief hermine, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Jean-Christian Denis, Franck Paul and contributors
 *
 * @copyright Jean-Christian Denis, Franck Paul
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

namespace Dotclear\Plugin\hermine;

use dcCore;
use Dotclear\Helper\L10n;

/**
 * Plugin definitions
 */
class My
{
    /**
     * This module id
     */
    public static function id(): string
    {
        return basename(dirname(__DIR__));
    }

    /**
     * This module name
     */
    public static function name(): string
    {
        return __((string) dcCore::app()->plugins->moduleInfo(self::id(), 'name'));
    }

    /**
     * This module directory path
     */
    public static function path(): string
    {
        return dirname(__DIR__);
    }

    /**
     * Set module locales.
     *
     * @param   string  $process    The locales process (ie filename as main, admin, …)
     */
    final public static function l10n(string $process): void
    {
        L10n::set(implode(DIRECTORY_SEPARATOR, [static::path(), 'locales', dcCore::app()->lang, $process]));
    }

    // Contexts

    /** @var int Install context */
    public const INSTALL = 0;

    /** @var int Prepend context */
    public const PREPEND = 1;

    /** @var int Frontend context */
    public const FRONTEND = 2;

    /** @var int Backend context (usually when the connected user may access at least one functionnality of this module) */
    public const BACKEND = 3;

    /** @var int Manage context (main page of module) */
    public const MANAGE = 4;

    /** @var int Config context (config page of module) */
    public const CONFIG = 5;

    /** @var int Menu context (adding a admin menu item) */
    public const MENU = 6;

    /** @var int Widgets context (managing blog's widgets) */
    public const WIDGETS = 7;

    /** @var int Uninstall context */
    public const UNINSTALL = 8;

    /**
     * Check permission depending on given context
     *
     * @param      int   $context  The context
     *
     * @return     bool  true if allowed, else false
     */
    public static function checkContext(int $context): bool
    {
        switch ($context) {
            case self::INSTALL:
                // Installation of module
                // ----------------------
                // In almost all cases, only super-admin should be able to install a module

                return defined('DC_CONTEXT_ADMIN')
                    && dcCore::app()->auth->isSuperAdmin()   // Super-admin only
                    && dcCore::app()->newVersion(self::id(), dcCore::app()->plugins->moduleInfo(self::id(), 'version'))
                ;

            case self::UNINSTALL:
                // Uninstallation of module
                // ------------------------
                // In almost all cases, only super-admin should be able to uninstall a module

                return defined('DC_RC_PATH')
                    && dcCore::app()->auth->isSuperAdmin()   // Super-admin only
                ;

            case self::PREPEND:
                // Prepend context
                // ---------------

                return defined('DC_RC_PATH')
                ;

            case self::FRONTEND:
                // Frontend context
                // ----------------

                return defined('DC_RC_PATH')
                ;

            case self::BACKEND:
                // Backend context
                // ---------------
                // As soon as a connected user should have access to at least one functionnality of the module
                // Note that PERMISSION_ADMIN implies all permissions on current blog

                return defined('DC_CONTEXT_ADMIN')
                    // Check specific permission
                    && dcCore::app()->blog && dcCore::app()->auth->check(dcCore::app()->auth->makePermissions([
                        dcCore::app()->auth::PERMISSION_USAGE,
                        dcCore::app()->auth::PERMISSION_CONTENT_ADMIN,
                    ]), dcCore::app()->blog->id)
                ;

            case self::MANAGE:
                // Main page of module
                // -------------------
                // In almost all cases, only blog admin and super-admin should be able to manage a module

                return defined('DC_CONTEXT_ADMIN')
                    // Check specific permission
                    && dcCore::app()->blog && dcCore::app()->auth->check(dcCore::app()->auth->makePermissions([
                        dcCore::app()->auth::PERMISSION_ADMIN,  // Admin+
                    ]), dcCore::app()->blog->id)
                ;

            case self::CONFIG:
                // Config page of module
                // ---------------------
                // In almost all cases, only super-admin should be able to configure a module

                return defined('DC_CONTEXT_ADMIN')
                    && dcCore::app()->auth->isSuperAdmin()   // Super-admin only
                ;

            case self::MENU:
                // Admin menu
                // ----------
                // In almost all cases, only blog admin and super-admin should be able to add a menuitem if
                // the main page of module is used for configuration, but it may be necessary to modify this
                // if the page is used to manage anything else

                return defined('DC_CONTEXT_ADMIN')
                    // Check specific permission
                    && dcCore::app()->blog && dcCore::app()->auth->check(dcCore::app()->auth->makePermissions([
                        dcCore::app()->auth::PERMISSION_ADMIN,  // Admin+
                    ]), dcCore::app()->blog->id)
                ;

            case self::WIDGETS:
                // Blog widgets
                // ------------
                // In almost all cases, only blog admin and super-admin should be able to manage blog's widgets

                return defined('DC_CONTEXT_ADMIN')
                    // Check specific permission
                    && dcCore::app()->blog && dcCore::app()->auth->check(dcCore::app()->auth->makePermissions([
                        dcCore::app()->auth::PERMISSION_ADMIN,  // Admin+
                    ]), dcCore::app()->blog->id)
                ;
        }

        return false;
    }

    /**
     * Get modules icon URLs.
     *
     * Will use SVG format is exist, else PNG
     *
     * @param   string    $suffix   Optionnal suffix (will be prefixed by - if any)
     *
     * @return  array<int,string>   The module icons URLs
     */
    public static function icons(string $suffix = ''): array
    {
        $check = fn (string $base, string $name) => (file_exists($base . DIRECTORY_SEPARATOR . $name . '.svg') ?
            static::fileURL($name . '.svg') :
            (file_exists($base . DIRECTORY_SEPARATOR . $name . '.png') ?
                static::fileURL($name . '.png') :
                false));

        $icons = [];
        if (defined('DC_CONTEXT_ADMIN')) {
            // Light mode version
            if ($icon = $check(static::path(), 'icon' . ($suffix !== '' ? '-' . $suffix : ''))) {
                $icons[] = $icon;
            }
            // Dark mode version
            if ($icon = $check(static::path(), 'icon-dark' . ($suffix !== '' ? '-' . $suffix : ''))) {
                $icons[] = $icon;
            }
        }
        if (!count($icons) && $suffix) {
            // Suffixed icons not found, try without
            return static::icons();
        }

        return $icons;
    }

    /**
     * Returns URL of a module file.
     *
     * In frontend it returns public URL,
     * In backend it returns admin URL (or public with $frontend=true)
     *
     * @param   string  $resource   The resource file
     * @param   bool    $frontend   Force to get frontend (public) URL even in backend
     *
     * @return  string
     */
    public static function fileURL(string $resource, bool $frontend = false): string
    {
        if (!empty($resource) && substr($resource, 0, 1) !== '/') {
            $resource = '/' . $resource;
        }
        if (defined('DC_CONTEXT_ADMIN') && DC_CONTEXT_ADMIN && !$frontend) {
            return is_null(dcCore::app()->adminurl) ? '' : urldecode(dcCore::app()->adminurl->get('load.plugin.file', ['pf' => self::id() . $resource]));
        }

        return is_null(dcCore::app()->blog) ? '' : urldecode(dcCore::app()->blog->getQmarkURL() . 'pf=' . self::id() . $resource);
    }

    /**
     * Return URL regexp scheme cope by the plugin
     *
     * @return     string
     */
    public static function urlScheme(): string
    {
        return '/' . preg_quote(dcCore::app()->adminurl->get('admin.plugin.' . self::id())) . '(&.*)?$/';
    }

    /**
     * Makes an url including optionnal parameters.
     *
     * @param      array   $params  The parameters
     *
     * @return     string
     */
    public static function makeUrl(array $params = []): string
    {
        return dcCore::app()->adminurl->get('admin.plugin.' . self::id(), $params);
    }
}
