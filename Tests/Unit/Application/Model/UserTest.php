<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Tests\Unit\Application\Model\User;

use HkReuter\OxSampleModule\Tests\DataCreator;
use OxidEsales\EshopCommunity\Core\Exception\StandardException;

/**
 * Class UserTest
 *
 * @package HkReuter\OxSampleModule\Tests\Unit\Core
 */
class UserTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
	/**
	 * Test setup.
	 */
	protected function setUp()
	{
		parent::setUp();

		$dataCreator = oxNew(DataCreator::class);
		$dataCreator->createUser();
	}

	/**
	 * Test tearDown.
	 */
	protected function tearDown()
	{
		$this->cleanUpTable('oxuser', 'oxid');

		parent::tearDown();
	}

	/**
	 * Test default value.
	 */
	public function testUserGetStatusDefault()
	{
		$user = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
		$user->load(DataCreator::USER_ID);
		$this->assertEquals('active', $user->getStatus());
	}

	/**
	 * Test set invalid value.
	 */
	public function testUserSetStatusError()
	{
		$user = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
		$user->load(DataCreator::USER_ID);

		if (method_exists($this, 'expectException')) {
			$this->expectException(StandardException::class);
			$this->expectExceptionMessage('Invalid status: OXSAMPLE_STATUS_WAHOO');
		} else {
			$this->setExpectedException(StandardException::class, 'Invalid status: OXSAMPLE_STATUS_WAHOO');
		}

		$user->setStatus('wahoo');
	}

	/**
	 * @return array
	 */
	public function DataProviderSetGetStatus()
	{
		return [
			'active'   => [
				'active'
			],
			'inactive' => [
				'inactive'
			],
			'blocked' => [
				'blocked'
			]
		];
	}

	/**
	 * @dataProvider DataProviderSetGetStatus
	 */
	public function testSetGetStatus($status)
	{
		$user = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
		$user->load(DataCreator::USER_ID);
		$user->setStatus($status);

		//verify it was set in current object
		$this->assertEquals($status, $user->getStatus());

		//verify it was saved into database
		$user = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
		$user->load(DataCreator::USER_ID);
		$this->assertEquals($status, $user->getStatus());
	}
}
