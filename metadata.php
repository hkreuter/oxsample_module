<?php
/**
 * Copyright © hkreuter. All rights reserved.
 * See LICENSE file for license details.
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
	'id'           => \HkReuter\OxSampleModule\Core\Module::MODULE_ID,
	'title'        => 'OxSample Module',
	'description'  => [
		'de' => 'OXID eShop 6 Example Modul.',
		'en' => 'OXID eShop 6 Example Module.',
	],
	'thumbnail'    => 'logo.png',
	'version'      => '0.0.1',
	'author'       => 'hkreuter',
	'url'          => 'https://github.com/hkreuter',
	'email'        => 'heike.reuter@oxid-esales.com',
	'extend'       => [
		\OxidEsales\Eshop\Application\Model\User::class => \HkReuter\OxSampleModule\Application\Model\User::class
	],
	'controllers' => [
	],
	'events' => [
		'onActivate'   => 'HkReuter\OxSampleModule\Core\Module::onActivate',
		'onDeactivate' => 'HkReuter\OxSampleModule\Core\Module::onDeactivate',
	],
	'templates' => [
	],
	'blocks' => [
	],
	'settings' => [
		/** Main */
		[
			'group'       => 'oxsample_main',
			'name'        => 'OxSampleGreetingMode',
			'type'        => 'select',
			'constraints' => 'polite|impolite',
			'value'       => 'polite'
		],
	],
	'smartyPluginDirectories' => [
	]
];
