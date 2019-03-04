<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Application\Controller;

/**
 * Class FrontendController
 * @package HkReuter\OxSampleModule\Application\Controller
 */
class FrontendController extends \OxidEsales\Eshop\Application\Controller\FrontendController
{
	/**
	 * Current view template
	 *
	 * @var string
	 */
	protected $_sThisTemplate = 'oxsample_frontend.tpl';
	
	/**
	 * TriggerController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Rendering method.
	 *
	 * @return mixed
	 */
	public function render()
	{
		$template = parent::render();
		return $template;
	}

	/**
	 * Add information to template.
	 *
	 * @return int
	 */
	public function doSomethingAction()
	{
		$this->_aViewData['oxsample_greeting'] = "OXSAMPLE_MODULE_DOSOMETHING";
		$this->_aViewData['oxsample_date'] = date('Y-m-d H:i:s');

		return 'hkreuter_oxsample_controller';
	}
}