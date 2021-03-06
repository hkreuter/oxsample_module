<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Tests;

/**
 * Class DataCreator
 *
 * @package HkReuter\OxSampleModule\Tests
 */
class DataCreator
{
	const USER_ID = '_testuserId';

	/**
	 * Create a test user.
	 */
	public function createUser()
	{
		$data = [
			'oxfname'     => 'Dörte',
			'oxlname'     => 'Glupsch',
			'oxusername'  => 'oxsample@oxideshop.dev',
			'oxpassword'  => '5c29d6541f49f0794e5484187ee72c57e11f045b366b7bfb99abec67397d894b7a1618786481cd47ba1c2' .
			                 'c1e17295b581fed90951de962406f59c5bad3fc6644', //password is asdfasdf
			'oxactive'    => 1,
			'oxcountryid' => 'a7c40f631fc920687.20179984',
			'oxboni'      => '666',
			'oxrights'    => 'user',
			'oxcustnr'    => '101',
			'oxstreet'    => 'Lehener Strasse',
			'oxstreetnr'  => '158',
			'oxzip'       => '79106',
			'oxcity'      => 'Freiburg',
			'oxsal'       => 'MRS'
		];

		$user = oxNew(\OxidEsales\Eshop\Application\Model\User::class);
		$user->setId(self::USER_ID);
		$user->assign($data);
		$user->save();

		//Unless we are admin, we cannot add oxpasssalt via model, so do is directly in database
		$query = "UPDATE oxuser SET oxpasssalt = 'd552ed74c7977b5ba8741744c0b2c9ff' WHERE oxid = '" . self::USER_ID . "'";
		\OxidEsales\Eshop\Core\DatabaseProvider::getDb()->execute($query);
	}
}
