<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Application\Model;

/**
 * Class Object2Fish
 * @package HkReuter\OxSampleModule\Application\Model
 */
class Object2Fish extends \OxidEsales\Eshop\Core\Model\BaseModel
{
	/**
	 * Current class name
	 *
	 * @var string
	 */
	protected $_sClassName = \HkReuter\OxSampleModule\Core\Module::MODULE_TABLE_NAME;

	/**
	 * Class constructor, initiates parent constructor (parent::oxBase()) and sets table name.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->init(\HkReuter\OxSampleModule\Core\Module::MODULE_TABLE_NAME);
	}

	/**
	 * Returns assigned object id
	 *
	 * @return string
	 */
	public function getObjectId()
	{
		return $this->getFieldData('oxobjectid');
	}

	/**
	 * Assign object id
	 *
	 * @param string $objectId Assigned object id
	 */
	public function setObjectId($objectId)
	{
		$this->assign(['oxobjectid' => $objectId]);
	}

	/**
	 * Returns assigned fishname
	 *
	 * @return string
	 */
	public function getFishName()
	{
		return $this->getFieldData('fishname');
	}

	/**
	 * Sets assigned category id
	 *
	 * @param string $fishName Assigned fish name
	 */
	public function setFishName($fishName)
	{
		$this->assign(['fishname' => $fishName]);
	}
}