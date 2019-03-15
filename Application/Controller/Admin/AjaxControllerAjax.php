<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Application\Controller\Admin;

/**
 * Class AjaxControllerAjax
 * @package HkReuter\OxSampleModule\Application\Controller\Admin
 */
class AjaxControllerAjax extends \OxidEsales\Eshop\Application\Controller\Admin\ListComponentAjax
{
	/**
	 * Count main categories.
	 */
	public function getCountOfMainCategories()
	{
		$query = "SELECT count(*) FROM oxcategories WHERE oxparentid = 'oxrootid'";
		$count = \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->getOne($query);

		$this->_output('This shop has ' . $count . ' main categories.');
	}
}