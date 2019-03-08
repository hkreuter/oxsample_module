<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Tests\Integration\Controller;

use HkReuter\OxSampleModule\Tests\Integration\TestHelper;

/**
 * Class FrontendControllerTest
 * @package HkReuter\OxSampleModule\Tests\Integration\Controller
 */
class FrontendControllerTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
	/**
	 * Test set up
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->activateTheme('flow');
	}

	/*
	 * Verify that the controller can be accessed
	 */
    public function testController()
    {
    	$parameters = [
    		'cl' => 'hkreuter_oxsample_controller'
	    ];
    	$shopUrl = $this->getConfigParam('sShopURL');
    	$helper = oxNew(TestHelper::class, $shopUrl, $parameters);
        $helper->execute();

        $this->assertContains('OXID eShop 6 Example Module', $helper->getCurlResult());
    }
}