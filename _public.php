<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of Hermine, a theme for Dotclear 2.
# based on WP eponym theme from Leo Babuta (http://leobabauta.com and http://zenhabits.net/themes)
#
# Copyright (c) Franck Paul and contributors
# carnet.franck.paul@gmail.com
#
# Licensed under the GPL version 2.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_RC_PATH')) { return; }

# Templates
$core->tpl->addBlock('IfEntryFirstImage',array('tplHermineTheme','IfEntryFirstImage'));

class tplHermineTheme
{
	public static function IfEntryFirstImage($attr,$content)
	{
		$size = !empty($attr['size']) ? $attr['size'] : '';
		$class = !empty($attr['class']) ? $attr['class'] : '';
		$with_category = !empty($attr['with_category']) ? 1 : 0;
		$no_tag = !empty($attr['no_tag']) ? 1 : 0;
		$content_only = !empty($attr['content_only']) ? 1 : 0;
		$cat_only = !empty($attr['cat_only']) ? 1 : 0;

		return
			"<?php if (context::EntryFirstImageHelper('".addslashes($size)."',".$with_category.",'".addslashes($class)."',".
			$no_tag.",".$content_only.",".$cat_only.") != '') : ?>".
			$content.
			"<?php endif; ?>";
	}
}
