<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Application\Controller\Admin;

use \OxidEsales\Eshop\Core\Registry;

/**
 * Class AjaxController
 * @package HkReuter\OxSampleModule\Application\Controller\Admin
 */
class AjaxController extends \OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController
{
	/**
	 * Render method.
	 * 
	 * @return string
	 */
	public function render()
	{
		parent::render();

		if (Registry::getRequest()->getRequestParameter('aoc')) {
			$ajax = oxNew(\HkReuter\OxSampleModule\Application\Controller\Admin\AjaxControllerAjax::class);
			$this->_aViewData['oxajax'] = $ajax->getCountOfMainCategories();
			return 'ajax_popup.tpl';
		}
		return 'ajax_controller.tpl';
	}
}