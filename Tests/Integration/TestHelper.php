<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Tests\Integration;

use HkReuter\OxSampleModule\Tests\DataCreator;
use OxidEsales\EshopCommunity\Core\Exception\StandardException;

/**
 * Class TestHelper
 * @package HkReuter\OxSampleModule\Tests\Integration
 */
class TestHelper extends \OxidEsales\TestingLibrary\UnitTestCase
{
	const COOKIE_NAME = 'OXSAMPLE_MODULE';

	const TEST_RESULT_DIR = 'OXSAMPLE_MODULE';

	/**
	 * Url to call.
	 *
	 * @var string
	 */
	private $url = null;

	/**
	 * Post parameters
	 *
	 * @var array
	 */
	private $parameters = [];

	/**
	 * Result from last curl result.
	 *
	 * @var string
	 */
	private $curlResult = '';

	/**
	 * Curl info
	 *
	 * @var array
	 */
	private $curlInfo = [];

	/**
	 * Method GET or POST.
	 *
	 * @var string
	 */
	private $method;

	/**
	 * Sets page url and parameters, which will be used for executing the call.
	 *
	 * @param string $url        Page url
	 * @param array  $parameters Parameters
	 * @param string $method     GET or POST
	 */
	public function __construct($url, $parameters = [], $method = 'GET')
	{
		$this->url = $url;
		$this->parameters = $parameters;
		$this->method = $method;
	}

	/**
	 * Returns curl result.
	 *
	 * @return string|false Returns false if page call was unsuccessful.
	 */
	public function getCurlResult()
	{
		if (empty($this->curlResult)) {
			$this->execute();
		}
		return $this->curlResult;
	}

	/**
	 * Returns curl info.
	 *
	 * @return array
	 */
	public function getCurlInfo()
	{
		return $this->curlInfo;
	}

	/**
	 * Deletes cookie file if it exists.
	 */
	public function deleteCookies()
	{
		if (file_exists($this->getCookieFilePath())) {
			unlink($this->getCookieFilePath());
		}
	}

	/**
	 * Execute curl
	 *
	 * @param bool $newCookieSession Reuse cookies yes/no
	 *
	 */
	public function execute($newCookieSession = false)
	{
		$ch = $this->getCurl($newCookieSession);
		$this->curlResult = curl_exec($ch);
		$this->curlInfo = curl_getinfo($ch);
		curl_close($ch);
	}

	/**
	 * Forms and returns cookie file path.
	 *
	 * @return string
	 */
	private function getCookieFilePath()
	{
		return $this->getTestResultDirectory() . DIRECTORY_SEPARATOR . self::COOKIE_NAME;
	}

	/**
	 * Returns temporary directory path, which is used for storing cookies and page information.
	 *
	 * @return string
	 */
	private function getTestResultDirectory()
	{
		$testResultDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . self::TEST_RESULT_DIR;
		if (!file_exists($testResultDir)) {
			mkdir($testResultDir, 0777, true);
		}
		return $testResultDir;
	}

	/**
	 * Prepare curl resource
	 *
	 * @param bool $newCookieSession
	 *
	 * @return resource
	 */
	private function getCurl($newCookieSession)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "OXSAMPLE-TEST");
		curl_setopt($ch, CURLOPT_COOKIESESSION, $newCookieSession);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->getCookieFilePath());
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->getCookieFilePath());
		curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		$parameters = '';
		foreach ($this->parameters as $key => $value) {
			$parameters .= $key . '=' . $value . '&';
		}
		$parameters = trim($parameters, '&');

		if ('GET' == $this->method) {
			$parameters = !empty($parameters) ? 'index.php?' . $parameters : '';
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
			curl_setopt($ch, CURLOPT_URL, $this->url . $parameters);
		} else {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
		}
		return $ch;
	}
}