<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

/**
 * Smarty function
 * -------------------------------------------------------------
 * Purpose: set params and render widget
 * Use [{oxid_include_widget="..."}]
 * -------------------------------------------------------------
 *
 * @param array  $params Params
 * @param Smarty $smarty Smarty
 *
 * @return string
 */
function smarty_function_oxid_include_widget($params, &$smarty)
{
	$class = isset($params['cl']) ? strtolower($params['cl']) : '';

	if ('off' == \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('OxSampleWidgetMode')) {
        $result = $class;
	} else {
		//original shop code
		unset($params['cl']);

		$parentViews = null;
		if (!empty($params["_parent"])) {
			$parentViews = explode("|", $params["_parent"]);
			unset($params["_parent"]);
		}

		$widgetControl = \OxidEsales\Eshop\Core\Registry::get(\OxidEsales\Eshop\Core\WidgetControl::class);
		$result = $widgetControl->start($class, null, $params, $parentViews);
	}
	return $result;
}
