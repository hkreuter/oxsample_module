<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Application\Component;

/**
 * Class OxSample
 *
 * NOTE:
 * Register own component in config.inc.php:
 *
 * class_exists(\HkReuter\OxSampleModule\Application\Component\OxSample::class);
 * $this->aUserComponentNames = ['oxcmp_oxsample' => 1];
 *
 * @package HkReuter\OxSampleModule\Application\Component
 */
class OxSample extends \OxidEsales\Eshop\Application\Controller\FrontendController
{
	/**
	 * Marking object as component
	 *
	 * @var bool
	 */
	protected $_blIsComponent = true;

	/**
	 * Init method
	 */
	public function init()
    {
    	//do nothing
    }

	/**
	 * Loads basket ($oBasket = $mySession->getBasket()), calls oBasket->calculateBasket,
	 * executes parent::render() and returns basket object.
	 *
	 * @return object   $oBasket    basket object
	 */
	public function render()
	{
		$fishPond = \OxidEsales\Eshop\Core\Registry::get(\HkReuter\OxSampleModule\Core\FishPond::class);

		parent::render();

		return $fishPond ;
	}
}

/**
 * Class alias is needed to make this work in templates.
 */
class_alias(\HkReuter\OxSampleModule\Application\Component\OxSample::class, 'oxcmp_oxsample');
