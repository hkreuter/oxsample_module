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
	'controllers'  => [
		'hkreuter_oxsample_controller' => \HkReuter\OxSampleModule\Application\Controller\FrontendController::class
	],
	'events' => [
		'onActivate'   => 'HkReuter\OxSampleModule\Core\Module::onActivate',
		'onDeactivate' => 'HkReuter\OxSampleModule\Core\Module::onDeactivate',
	],
	'templates' => [
		'oxsample_frontend.tpl' => 'hkreuter/oxsample/Templates/oxsample_frontend.tpl',
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
		/** smarty */
		[
			'group'       => 'oxsample_frontend',
			'name'        => 'OxSampleWidgetMode',
			'type'        => 'select',
			'constraints' => 'on|off',
			'value'       => 'on'
		],
	],
	'smartyPluginDirectories' => [
		'Core/Smarty/Plugin'
	]
];
