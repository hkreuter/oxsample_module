<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Tests\Integration\Event;

use HkReuter\OxSampleModule\Tests\DataCreator;

/**
 * Class BasketChangedEventTest
 * @package HkReuter\OxSampleModule\Tests\Integration\Controller
 */
class BasketChangedEventTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
	/**
	 * Test set up
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

		parent::tearDown();
	}

	/*
	 * Verify that BasketChanged event is handled by module.
	 */
	public function testBasketChangeEventIsHandled()
	{
		$article = oxNew(\OxidEsales\Eshop\Application\Model\Article::class);
		$article->load(DataCreator::ARTICLE_ID);
		$this->assertEquals(0, $article->getFieldData('oxsample_counter'));

        $basketComponent = oxNew(\OxidEsales\Eshop\Application\Component\BasketComponent::class);
		$basketComponent->toBasket(DataCreator::ARTICLE_ID, 1);

		$article = oxNew(\OxidEsales\Eshop\Application\Model\Article::class);
		$article->load(DataCreator::ARTICLE_ID);
		$this->assertEquals(1, $article->getFieldData('oxsample_counter'));
	}
}