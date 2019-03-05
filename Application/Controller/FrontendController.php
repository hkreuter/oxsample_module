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
	const GREETING_MODE_CONFIG_VARNAME = 'OxSampleGreetingMode';

	const OXSAMPLE_CONTROLLER_SESSION_VARNAME = 'OxSampleSessionInfo';

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
		$session = \OxidEsales\Eshop\Core\Registry::getSession();
		$info = $session->getVariable(self::OXSAMPLE_CONTROLLER_SESSION_VARNAME) ? $session->getVariable(self::OXSAMPLE_CONTROLLER_SESSION_VARNAME) : '';
		$this->_aViewData['oxsample_info'] = $info;

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
		$postfix = 'polite';
		if (\OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam(self::GREETING_MODE_CONFIG_VARNAME)) {
			$postfix = \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam(self::GREETING_MODE_CONFIG_VARNAME);
		}

		$this->_aViewData['oxsample_greeting'] = "OXSAMPLE_MODULE_DOSOMETHING_" . strtoupper($postfix);
		$this->_aViewData['oxsample_date'] = date('Y-m-d H:i:s');
	}

	/**
	 * Add information to session.
	 *
	 * @return int
	 */
	public function doSomethingElseAction()
	{
		$language = \OxidEsales\Eshop\Core\Registry::getLang();
		$value = sprintf($language->translateString('OXSAMPLE_MODULE_DOSOMETHING_ELSE', $language->getBaseLanguage()), date('Y-m-d h:i:s'));
		\OxidEsales\Eshop\Core\Registry::getSession()->setVariable(self::OXSAMPLE_CONTROLLER_SESSION_VARNAME, $value);

		return 'hkreuter_oxsample_controller';
	}
}