<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Application\Model;

/**
 * Class User
 */
class User extends User_parent
{
	const OXSAMPLE_STATUS_ACTIVE   = 'active';
	const OXSAMPLE_STATUS_INACTIVE = 'inactive';
	const OXSAMPLE_STATUS_BLOCKED  = 'blocked';

	/**
	 * Status setter
	 */
	public function setStatus($status)
	{
		$constName = 'OXSAMPLE_STATUS_' . strtoupper($status);
		$rawConst = 'static::' . $constName;
        if (defined($rawConst)) {
	        $this->assign(['oxsample_status' => constant($rawConst)]);
	        $this->save();
        } else {
        	throw new \OxidEsales\EshopCommunity\Core\Exception\StandardException('Invalid status: ' . $constName);
        }
	}

	/**
	 * Status getter
	 */
	public function getStatus()
	{
		return $this->getFieldData('oxsample_status');
	}

}