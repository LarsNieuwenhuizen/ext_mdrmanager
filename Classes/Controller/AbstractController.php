<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Lars Nieuwenhuizen <lars.nieuwenhuizen@me.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Abstract Controller
 *
 * @package mdrmanager
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Mdrmanager_Controller_AbstractController extends Tx_Extbase_MVC_Controller_ActionController {
	/**
	 * @var object mdr API
	 */
	protected $mdr;

	/**
	 * Initialize mdr API
	 */
	public function __construct() {
		$this->mdr = t3lib_div::makeInstance('Tx_Mdrmanager_3rdParty_mdrApi');
	}

	/**
	 * If there are errors with the transaction set errors to view
	 *
	 * @param Tx_Mdrmanager_3rdParty_mdrApi $mdr
	 * @return boolean
	 */
	protected function _checkForErrors(Tx_Mdrmanager_3rdParty_mdrApi $mdr) {
		if($mdr->Values['errcount'] > 0) {
			for($i = 1; $i <= $mdr->Values['errcount']; $i++) {
				$this->flashMessageContainer->add($mdr->Values[ "errnotxt".$i ] . ' code: ' . $mdr->Values[ "errno".$i ]);
			}
			return 'true';
		} else {
			return 'false';
		}
	}
}

?>