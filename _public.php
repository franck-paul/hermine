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

namespace themes\hermine;

if (!defined('DC_RC_PATH')) {
    return;
}

# Templates
\dcCore::app()->tpl->addBlock('IfEntryFirstImage', [__NAMESPACE__ . '\tplHermineTheme', 'IfEntryFirstImage']);

class tplHermineTheme
{
    public static function IfEntryFirstImage($attr, $content)
    {
        $size          = empty($attr['size']) ? '' : $attr['size'];
        $class         = empty($attr['class']) ? '' : $attr['class'];
        $with_category = empty($attr['with_category']) ? 0 : 1;
        $no_tag        = empty($attr['no_tag']) ? 0 : 1;
        $content_only  = empty($attr['content_only']) ? 0 : 1;
        $cat_only      = empty($attr['cat_only']) ? 0 : 1;

        return
        "<?php if (context::EntryFirstImageHelper('" . addslashes($size) . "'," . $with_category . ",'" . addslashes($class) . "'," .
            $no_tag . ',' . $content_only . ',' . $cat_only . ") != '') : ?>" .
            $content .
            '<?php endif; ?>';
    }
}
