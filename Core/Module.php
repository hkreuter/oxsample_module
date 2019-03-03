<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

namespace HkReuter\OxSampleModule\Core;

/**
 * Class Module
 *
 * @package HkReuter\OxSampleModule\Core
 */
class Module
{
	const MODULE_ID = 'hkreuter/oxsample-module';

	/**
	 * Files that are not deleted.
	 *
	 * @var array
	 */
	static protected $keepThese = [
		'.',
		'..',
		'.gitkeep',
		'.htaccess'
	];

	/**
	 * On module activation
	 */
	public function onActivate()
	{
		self::extendShopDataModel();
		self::insertSeoUrls();
		self::clearTmp();
	}

	/**
	 * On module deactivation
	 */
	public function onDeactivate()
	{
		self::removeSeoUrls();
		self::clearTmp();
	}

	/**
	 * Clean temp folder content.
	 */
	public static function clearTmp()
	{
		$compileDir = (string) \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('sCompileDir');
		if (is_dir($compileDir)) {
			static::clearDirectory($compileDir);
		}
	}

	/**
	 * Clean temp folder content.
	 *
	 * @param string $clearFolderPath Sub-folder path to delete from.
	 *
	 * @return boolean
	 */
	private static function clearDirectory($directoryPath)
	{
		$directoryHandler = opendir($directoryPath);
		if (!empty($directoryHandler)) {
			while (false !== ($fileName = readdir($directoryHandler))) {
				$filePath = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
				self::clear($fileName, $filePath);
			}
			closedir($directoryHandler);
		}
		return true;
	}

	/**
	 * Check if resource could be deleted, then delete it's a file or
	 * call recursive folder deletion if it's a directory.
	 *
	 * @param string $fileName
	 * @param string $filePath
	 */
	private static function clear($fileName, $filePath)
	{
		if (!in_array($fileName, ['.', '..', '.gitkeep', '.htaccess'])) {
			if (is_file($filePath)) {
				@unlink($filePath);
			} else {
				self::clearDirectory($filePath);
			}
		}
	}

	/**
	 * Add columns to shop tables.
	 * Curently only oxuser is extended.
	 */
	public static function extendShopDataModel()
	{
		$dbMetaDataHandler = oxNew(\OxidEsales\Eshop\Core\DbMetaDataHandler::class);
		$tableFields = [
			'oxuser' => [
					'field' => 'OXSAMPLE_STATUS',
				    'specs' => " enum('active', 'inactive', 'blocked') NOT NULL DEFAULT 'active'"
				]
		];
		foreach ($tableFields as $tableName => $sub) {
			if (!$dbMetaDataHandler->fieldExists($sub['field'], $tableName)) {
				$query = "ALTER TABLE `" . $tableName . "` ADD `" . $sub['field'] . "` " . $sub['specs'];
				\OxidEsales\Eshop\Core\DatabaseProvider::getDb()->execute($query);
			}
		}
	}

	/**
	 * Insert seo link.
	 */
	private static function insertSeoUrls()
	{
        $oxobjectidDe = \OxidEsales\Eshop\Core\Registry::getUtilsObject()->generateUId();
        $oxobjectidEn = \OxidEsales\Eshop\Core\Registry::getUtilsObject()->generateUId();
        $stdurl = 'index.php?cl=hkreuter_oxsample_controller';
        $seoUrlDe = 'OxSample/BeispielModul/';
        $seoUrlEn = 'OxSample/ExampleModule/';
        $oxidentDe = md5(strtolower($seoUrlDe));
        $oxidentEn = md5(strtolower($seoUrlEn));
		$query = "INSERT INTO oxseo (oxobjectid, oxident, oxlang, oxstdurl, oxseourl, oxtype) VALUES " .
		         "('{$oxobjectidDe}', '{$oxidentDe}', 0, '{$stdurl}', '{$seoUrlDe}', 'static'), " .
		         "('{$oxobjectidEn}', '{$oxidentEn}', 1, '{$stdurl}', '{$seoUrlEn}', 'static')";

		\OxidEsales\Eshop\Core\DatabaseProvider::getDb()->execute($query);
	}

	/**
	 * Insert seo link.
	 */
	private static function removeSeoUrls()
	{
		$query = "DELETE FROM oxseo WHERE oxseourl like '%OxSample%' LIMIT 2";
		\OxidEsales\Eshop\Core\DatabaseProvider::getDb()->execute($query);
	}
}