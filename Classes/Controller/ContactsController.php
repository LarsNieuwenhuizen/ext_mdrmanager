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
class Tx_Mdrmanager_Controller_ContactsController extends Tx_Mdrmanager_Controller_AbstractController {

	/**
	 * List contacts and show other possibilities for contacts
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('step', 'contact_list');
		$this->mdr->AddParam('command', 'contact_list');
		$this->mdr->doTransaction();

		$this->_checkForErrors($this->mdr);

		$contacts = array();
		for($i=0; $i < $this->mdr->Values["contactcount"]; $i++){
			$contacts[$i]['id'] = $this->mdr->Values["contact_id[$i]"];
			$contacts[$i]['bedrijfsnaam'] = $this->mdr->Values["contact_bedrijfsnaam[$i]"];
			$contacts[$i]['voorletter'] = $this->mdr->Values["contact_voorletter[$i]"];
			$contacts[$i]['tussenvoegsel'] = $this->mdr->Values["contact_tussenvoegsel[$i]"];
			$contacts[$i]['achternaam'] = $this->mdr->Values["contact_achternaam[$i]"];
			$contacts[$i]['straat'] = $this->mdr->Values["contact_straat[$i]"];
			$contacts[$i]['huisnr'] = $this->mdr->Values["contact_huisnr[$i]"];
			$contacts[$i]['huisnrtoev'] = $this->mdr->Values["contact_huisnrtoev[$i]"];
			$contacts[$i]['postcode'] = $this->mdr->Values["contact_postcode[$i]"];
			$contacts[$i]['plaats'] = $this->mdr->Values["contact_plaats[$i]"];
			$contacts[$i]['land'] = $this->mdr->Values["contact_land[$i]"];
			$contacts[$i]['email'] = $this->mdr->Values["contact_email[$i]"];
			$contacts[$i]['tel'] = $this->mdr->Values["contact_tel[$i]"];
		}
		$this->view->assign('contacts', $contacts);

		$this->view->assign('legalForms', $this->legalForms);
		$this->view->assign('countries', $this->countries);
	}

	/**
	 * Show a form to add a new contact
	 */
	public function newContactFormAction() {
		$this->view->assign('step', 'add_contact');
		$this->view->assign('countries', $this->countries);
		$this->view->assign('postData', $this->request->getArguments());
		$this->view->assign('legalForms', $this->legalForms);
	}

	/**
	 * Add the contact
	 *
	 * @return void
	 */
	public function addAction() {
		$this->mdr->addParam('command', 'contact_add');
		foreach($this->request->getArguments() as $k => $v) {
			$this->mdr->addParam($k, $v);
		}
		$this->mdr->DoTransaction();
		$errors = $this->_checkForErrors($this->mdr);
		if($errors == 'false') {
			$this->flashMessageContainer->add('contact toegevoegd');
			$this->redirect('index');
		} else {
			$this->forward('newContactForm');
		}
	}
}

?>