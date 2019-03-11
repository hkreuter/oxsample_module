<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Core;

/**
 * Class FishPond
 * @package HkReuter\OxSampleModule\Core
 */
class FishPond
{
	/**
	 * @var array
	 */
	private $fishTypes = [
        'Karpfen',
		'Guppy',
		'Pangasius',
		'Makrele',
		'Hering',
		'Hai',
		'Aal',
		'Kabeljau',
		'Hecht',
		'Wels'
	];

	/**
	 * Fish name.
	 *
	 * @var string
	 */
	private $fish = '';

	/**
	 * Get a fish.
	 *
	 * @return string
	 */
    public function getFish(): string
    {
    	if (empty($this->fish)) {
    		$this->fish = $this->getRandomFish();
	    }
        return $this->fish;
    }
	
	/**
	 * Get a random fish name.
	 *
	 * @return string
	 */
	private function getRandomFish(): string
	{
        $key = rand(0, count($this->fishTypes) -1 );
        return $this->fishTypes[$key];
	}
}