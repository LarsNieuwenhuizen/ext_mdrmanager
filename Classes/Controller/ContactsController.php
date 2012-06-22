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
 * Contacts Controller
 *
 * @package mdrmanager
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Mdrmanager_Controller_ContactsController extends Tx_Extbase_MVC_Controller_ActionController {
	/**
	 * List contacts and show other possibilities for contacts
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('step', '1');
		$mdr = t3lib_div::makeInstance('Tx_Mdrmanager_3rdParty_mdrApi');
		$mdr->AddParam('command', 'contact_list');
		$mdr->doTransaction();

		$this->_checkForErrors($mdr);

		$contacts = array();
		for($i=0; $i<$mdr->Values["contactcount"]; $i++){
			$contacts[$i]['id'] = $mdr->Values[ "contact_id[$i]" ];
			$contacts[$i]['bedrijfsnaam'] = $mdr->Values[ "contact_bedrijfsnaam[$i]" ];
			$contacts[$i]['voorletter'] = $mdr->Values[ "contact_voorletter[$i]" ];
			$contacts[$i]['tussenvoegsel'] = $mdr->Values[ "contact_tussenvoegsel[$i]" ];
			$contacts[$i]['achternaam'] = $mdr->Values[ "contact_achternaam[$i]" ];
			$contacts[$i]['straat'] = $mdr->Values[ "contact_straat[$i]" ];
			$contacts[$i]['huisnr'] = $mdr->Values[ "contact_huisnr[$i]" ];
			$contacts[$i]['huisnrtoev'] = $mdr->Values[ "contact_huisnrtoev[$i]" ];
			$contacts[$i]['postcode'] = $mdr->Values[ "contact_postcode[$i]" ];
			$contacts[$i]['plaats'] = $mdr->Values[ "contact_plaats[$i]" ];
			$contacts[$i]['land'] = $mdr->Values[ "contact_land[$i]" ];
			$contacts[$i]['email'] = $mdr->Values[ "contact_email[$i]" ];
			$contacts[$i]['tel'] = $mdr->Values[ "contact_tel[$i]" ];
		}
		$this->view->assign('contacts', $contacts);
	}

	/**
	 * If there are errors with the transaction set errors to view
	 *
	 * @param Tx_Mdrmanager_3rdParty_mdrApi $mdr
	 * @return void
	 */
	protected function _checkForErrors(Tx_Mdrmanager_3rdParty_mdrApi $mdr) {
		if($mdr->Values['errcount'] > 0) {
			$errors = array();
			for($i = 1; $i <= $mdr->Values['errcount']; $i++) {
				$errors[$i]['errortxt'] = $mdr->Values[ "errnotxt".$i ];
				$errors[$i]['errorno'] = $mdr->Values[ "errno".$i ];
			}
			$this->view->assign('errors', $errors);
		}
	}
}

?>