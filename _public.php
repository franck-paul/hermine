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

if (!defined('DC_RC_PATH')) {return;}

# Templates
$core->tpl->addBlock('IfEntryFirstImage', array(__NAMESPACE__ . '\tplHermineTheme', 'IfEntryFirstImage'));

class tplHermineTheme
{
    public static function IfEntryFirstImage($attr, $content)
    {
        $size          = !empty($attr['size']) ? $attr['size'] : '';
        $class         = !empty($attr['class']) ? $attr['class'] : '';
        $with_category = !empty($attr['with_category']) ? 1 : 0;
        $no_tag        = !empty($attr['no_tag']) ? 1 : 0;
        $content_only  = !empty($attr['content_only']) ? 1 : 0;
        $cat_only      = !empty($attr['cat_only']) ? 1 : 0;

        return
        "<?php if (context::EntryFirstImageHelper('" . addslashes($size) . "'," . $with_category . ",'" . addslashes($class) . "'," .
            $no_tag . "," . $content_only . "," . $cat_only . ") != '') : ?>" .
            $content .
            "<?php endif; ?>";
    }
}
