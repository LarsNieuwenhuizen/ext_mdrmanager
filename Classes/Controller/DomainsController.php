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
 * Domains Controller
 *
 * @package mdrmanager
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Mdrmanager_Controller_DomainsController extends Tx_Mdrmanager_Controller_AbstractController {
	/**
	 * List all domains
	 *
	 * @return array domains
	 */
	public function listAction() {
		$this->view->assign('functionName', 'domain.list');
		$this->mdr->addParam('command', 'domain_list');
		$this->mdr->addParam('sort', 'registrant');
		$this->mdr->addParam('order', '1');
		$this->mdr->doTransaction();

		$this->_checkForErrors($this->mdr);
		$domains = array();

		for($i = 1; $i < $this->mdr->Values['domeincount']; $i++) {
			$domains[$i]['domain'] = $this->mdr->Values["domein[$i]"];
			$domains[$i]['registrant'] = $this->mdr->Values["registrant[$i]"];
			$domains[$i]['admin'] = $this->mdr->Values["admin[$i]"];
			$domains[$i]['tech'] = $this->mdr->Values["tech[$i]"];
			$domains[$i]['expiration_date'] = $this->mdr->Values["verloopdatum[$i]"];
			$domains[$i]['status'] = $this->mdr->Values["status[$i]"];
		}
		$this->view->assign('domains', $domains);

		$this->view->assign('domain_list', $this->mdr->Values);
	}

	/**
	 * Get full details of a domain
	 *
	 * @param string $domain
	 * @return object Tx_Mdrmanager_3rdParty_mdrApi
	 */
	protected function _getDomainDetails($domain) {
		$domainArray = explode('.', $domain);
		if(end($domainArray) === 'uk') {
			$domainTld = 'co.uk';
		} else {
			$domainTld = end($domainArray);
		}
		$domainWithoutTld = $domainArray[0];
		$this->mdr->addParam('command', 'domain_get_details');
		$this->mdr->addParam('domein', $domainWithoutTld);
		$this->mdr->addParam('tld', $domainTld);
		$this->mdr->doTransaction();
		$this->_checkForErrors($this->mdr);

		return $this->mdr->Values;
	}

	/**
	 * View the full details of a domain
	 */
	public function detailsAction() {
		$this->view->assign('functionName', 'domain.details');
		if($this->request->hasArgument('domain')) {
			$domain = $this->request->getArgument('domain');
			$this->view->assign('domainName', $domain['domain']);
			$this->view->assign('domain', $domain);
			$domain = $this->_getDomainDetails($domain['domain']);
			$domain['registrant_land'] = $this->countries[$domain['registrant_land']];
			$domain['admin_land'] = $this->countries[$domain['admin_land']];
			$domain['tech_land'] = $this->countries[$domain['tech_land']];
			foreach($domain as $k => $v) {
				$this->view->assign($k, $v);
			}
		}
	}

	/**
	 * Set the autorenew on or off
	 *
	 * @return void
	 */
	public function setAutoRenewAction() {
		$domain = $this->request->getArgument('domain');
		$domainArray = explode('.', $domain['domain']);
		if(end($domainArray) === 'uk') {
			$domainTld = 'co.uk';
		} else {
			$domainTld = end($domainArray);
		}

		$this->mdr->addParam('command', 'domain_set_autorenew');
		$this->mdr->addParam('domein', $domainArray[0]);
		$this->mdr->addParam('tld', $domainTld);
		$this->mdr->addParam('autorenew', $this->request->getArgument('autorenew'));

		$this->mdr->doTransaction();

		$this->_checkForErrors($this->mdr);
		$this->forward('details', 'Domains', 'mdrmanager', array('domain' => $this->request->getArgument('domain')));
	}
}

?>