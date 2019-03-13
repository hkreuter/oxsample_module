<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Tests\Unit\Application\Model\User;

use HkReuter\OxSampleModule\Tests\DataCreator;
use HkReuter\OxSampleModule\Application\Model\Object2Fish;
/**
 * Class Object2FishTest
 * @package HkReuter\OxSampleModule\Tests\Unit\Application\Model\User
 */
class Object2FishTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
	/**
	 * Test setup.
	 */
	protected function setUp()
	{
		parent::setUp();

		$dataCreator = oxNew(DataCreator::class);
		$dataCreator->createArticle();
	}

	/**
	 * Test tearDown.
	 */
	protected function tearDown()
	{
		$this->cleanUpTable('oxarticles', 'oxid');
		$this->cleanUpTable(\HkReuter\OxSampleModule\Core\Module::MODULE_TABLE_NAME, 'oxid');

		parent::tearDown();
	}

	/**
	 * Test relation creation.
	 */
	public function testObject2Fish()
	{
		$data = [
			'oxid'       => '_test',
			'oxobjectid' => DataCreator::ARTICLE_ID,
			'fishname'   => 'Makrele'
		];

		$relation = oxNew(Object2Fish::class);
		$relation->assign($data);
		$this->assertEquals('_test', $relation->save());

		$relation = oxNew(Object2Fish::class);
		$relation->load('_test');
		$this->assertEquals(DataCreator::ARTICLE_ID, $relation->getFieldData('oxobjectid'));
	}
}