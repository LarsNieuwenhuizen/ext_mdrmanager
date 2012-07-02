<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	/* Enable new element in the tree */
	t3lib_extMgm::addModule('MDR', '', '', t3lib_extMgm::extPath($_EXTKEY).'mdr/');

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'MDR',	 // Make module a submodule of 'web'
		'domains',	// Submodule key
		'',						// Position
		array(
			'Domains' => 'list, details',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_domains.xml',
		)
	);

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'MDR',	 // Make module a submodule of 'web'
		'contacts',	// Submodule key
		'',						// Position
		array(
			'Contacts' => 'index, list, show, add, delete, newContactForm',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_contacts.xml',
		)
	);
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'MijnDomeinReseller Manager');

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

?>