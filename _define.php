<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of hermine, a theme for Dotclear 2.
#
# Copyright (c) Franck Paul and contributors
# carnet.franck.paul@gmail.com
#
# Licensed under the GPL version 2.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
	/* Name */			"Hermine",
	/* Description*/	"Hermine photoblog theme (based on Berlin)",
	/* Author */		"Franck Paul",
	/* Version */		'1.0.1',
	array(
		/* Type */				'type' =>					'theme',
		/* tplset */			'tplset' =>					'currywurst',
		/* Widget title */		'widgettitleformat' =>		'<h3 class="widget-title">%s</h3>',
		/* Widget subtitle */	'widgetsubtitleformat' =>	'<h4 class="widget-subtitle">%s</h4>'
	)
);
