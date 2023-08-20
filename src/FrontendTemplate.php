<?php
/**
 * @brief hermine, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

namespace Dotclear\Theme\hermine;

class FrontendTemplate
{
    public static function IfEntryFirstImage($attr, $content)
    {
        $size          = empty($attr['size']) ? '' : $attr['size'];
        $class         = empty($attr['class']) ? '' : $attr['class'];
        $with_category = empty($attr['with_category']) ? 'false' : 'true';
        $no_tag        = empty($attr['no_tag']) ? 'false' : 'true';
        $content_only  = empty($attr['content_only']) ? 'false' : 'true';
        $cat_only      = empty($attr['cat_only']) ? 'false' : 'true';

        return
        "<?php if (context::EntryFirstImageHelper('" . addslashes($size) . "'," . $with_category . ",'" . addslashes($class) . "'," .
            $no_tag . ',' . $content_only . ',' . $cat_only . ") != '') : ?>" .
            $content .
            '<?php endif; ?>';
    }
}
