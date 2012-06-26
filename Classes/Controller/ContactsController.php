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

	/*
	 * @var array countries and codes
	 */
	protected $countries = array(
		'af' => 'afghanistan',
		'al' => 'albanië',
		'dz' => 'algerije',
		'as' => 'american Samoa',
		'ad' => 'andorra',
		'ao' => 'angola',
		'ai' => 'anguilla',
		'aq' => 'antarctica',
		'ag' => 'antigua en Barbuda',
		'ar' => 'argentinië',
		'am' => 'armenië',
		'aw' => 'aruba',
		'au' => 'australië',
		'az' => 'azerbaijan',
		'bs' => 'Bahama\'s',
		'bh' => 'Bahrain',
		'bd' => 'Bangladesh',
		'bb' => 'Barbados',
		'by' => 'Belarus',
		'be' => 'België',
		'bz' => 'Belize',
		'bj' => 'Benin',
		'bm' => 'Bermuda',
		'bt' => 'Bhutan',
		'bo' => 'Bolivia',
		'ba' => 'Bosnië Herzegovína',
		'bw' => 'Botswana',
		'bv' => 'Bouvet Island',
		'br' => 'Brazilië',
		'io' => 'British Indian Ocean Territory',
		'bn' => 'Brunei Darussalam',
		'bg' => 'Bulgarije',
		'bf' => 'Burkina Faso',
		'bi' => 'Burundi',
		'kh' => 'Cambodia',
		'cm' => 'Cameroon',
		'ca' => 'Canada',
		'cf' => 'Centraal Afrika',
		'td' => 'Chad',
		'cl' => 'Chili',
		'cn' => 'China',
		'cx' => 'Christmas Eiland',
		'cc' => 'Cocos (Keeling) Islands',
		'co' => 'Colombia',
		'km' => 'Comoros',
		'cg' => 'Congo',
		'ck' => 'Cook Eilanden',
		'cr' => 'Costa Rica',
		'ci' => 'Cote Divoire (Ivory Coast)',
		'cu' => 'Cuba',
		'cy' => 'Cyprus',
		'dk' => 'Denemarken',
		'dj' => 'Djibouti',
		'dm' => 'Dominica',
		'do' => 'Dominicaanse Republiek',
		'de' => 'Duitsland',
		'ec' => 'Ecuador',
		'eg' => 'Egypte',
		'sv' => 'El Salvador',
		'gq' => 'Equatorial Guinea',
		'er' => 'Eritrea',
		'ee' => 'Estonië',
		'et' => 'Ethiopië',
		'fk' => 'Falkland Eilanden (Malvinas)',
		'fo' => 'Faroer Eilanden',
		'fj' => 'Fiji',
		'fi' => 'Finland',
		'fr' => 'Frankrijk',
		'gf' => 'Frans Guiana',
		'pf' => 'Frans Polynesië',
		'fx' => 'France (Metropolitan)',
		'tf' => 'French Southern Territories',
		'ga' => 'Gabon',
		'gm' => 'Gambia',
		'ge' => 'Georgië',
		'gh' => 'Ghana',
		'gi' => 'Gibraltar',
		'gd' => 'Grenada',
		'gr' => 'Griekenland',
		'gl' => 'Groenland',
		'gb' => 'Groot Brittanië (GBR)',
		'gp' => 'Guadeloupe',
		'gu' => 'Guam',
		'gt' => 'Guatemala',
		'gn' => 'Guinea',
		'gw' => 'Guinea-Bissau',
		'gy' => 'Guyana',
		'ht' => 'Haiti',
		'hm' => 'Heard and McDonald Islands',
		'hn' => 'Honduras',
		'hu' => 'Hongarije',
		'hk' => 'Hong Kong',
		'is' => 'IJsland',
		'ie' => 'Ierland',
		'in' => 'India',
		'id' => 'Indonesië',
		'iq' => 'Irak',
		'ir' => 'Iran',
		'il' => 'Israel',
		'it' => 'Italië',
		'jm' => 'Jamaica',
		'jp' => 'Japan',
		'yu' => 'Joegoslavië',
		'jo' => 'Jordanië',
		'ky' => 'Kaaiman Eilanden',
		'cv' => 'Kaap Verdië',
		'kz' => 'Kazakhstan',
		'ke' => 'Kenia',
		'ki' => 'Kiribati',
		'kw' => 'Koeweit',
		'hr' => 'Kroatië (Hrvatska)',
		'kg' => 'Kyrgyzstan',
		'la' => 'Laos',
		'ls' => 'Lesotho',
		'lv' => 'Letland',
		'lb' => 'Libanon',
		'lr' => 'Liberië',
		'ly' => 'Libië',
		'li' => 'Liechtenstein',
		'lt' => 'Litouwen',
		'lu' => 'Luxemburg',
		'vi' => 'Maagden Eilanden (VS)',
		'vg' => 'Maagden Eilanden (Brits)',
		'mo' => 'Macau',
		'mk' => 'Macedonië',
		'mg' => 'Madagascar',
		'mw' => 'Malawi',
		'mv' => 'Maldiven',
		'my' => 'Maleisië',
		'ml' => 'Mali',
		'mt' => 'Malta',
		'ma' => 'Marokko',
		'mh' => 'Marshall Eilanden',
		'mq' => 'Martinique',
		'mu' => 'Mauritius',
		'mr' => 'Mauritania',
		'yt' => 'Mayotte',
		'mx' => 'Mexico',
		'fm' => 'Micronesië',
		'md' => 'Moldova',
		'mc' => 'Monaco',
		'mn' => 'Mongolië',
		'ms' => 'Montserrat',
		'mz' => 'Mozambique',
		'mm' => 'Myanmar',
		'na' => 'Namibië',
		'nr' => 'Nauru',
		'nl' => 'Nederland',
		'an' => 'Nederlandse Antillen',
		'np' => 'Nepal',
		'nt' => 'Neutrale Zone',
		'ni' => 'Nicaragua',
		'nc' => 'Nieuw Caledonië',
		'nz' => 'Nieuw Zeeland (Aotearoa)',
		'ne' => 'Niger',
		'ng' => 'Nigeria',
		'nu' => 'Niue',
		'no' => 'Noorwegen',
		'kp' => 'Noord Korea',
		'mp' => 'Noordelijke Mariana Eilanden',
		'nf' => 'Norfolk Eilanden',
		'om' => 'Oman',
		'tp' => 'Oost Timor',
		'at' => 'Oostenrijk',
		'pk' => 'Pakistan',
		'pw' => 'Palau',
		'pa' => 'Panama',
		'pg' => 'Papua Nieuw Guinea',
		'py' => 'Paraguay',
		'pe' => 'Peru',
		'ph' => 'Philippijnen',
		'pn' => 'Pitcairn',
		'pl' => 'Polen',
		'pt' => 'Portugal',
		'pr' => 'Puerto Rico',
		'qa' => 'Qatar',
		're' => 'Reunion',
		'ro' => 'Roemenië',
		'ru' => 'Russische Federatie',
		'rw' => 'Rwanda',
		'gs' => 'S. Georgia en S. Sandwich Eil.',
		'vc' => 'Saint Vincent and the Grenadines',
		'ws' => 'Samoa',
		'sm' => 'San Marino',
		'st' => 'Sao Tome and Principe',
		'sa' => 'Saudi Arabië',
		'sn' => 'Senegal',
		'sc' => 'Seychellen',
		'sl' => 'Sierra Leone',
		'sg' => 'Singapore',
		'si' => 'Slovenië',
		'sk' => 'Slowakije',
		'sb' => 'Solomon Eilanden',
		'so' => 'Somalië',
		'es' => 'Spanje',
		'lk' => 'Sri Lanka',
		'sh' => 'St. Helena',
		'kn' => 'St. Kitts en Nevis',
		'lc' => 'St. Lucia',
		'pm' => 'St. Pierre and Miquelon',
		'sd' => 'Sudan',
		'sr' => 'Suriname',
		'sj' => 'Svalbard and Jan Mayen Islands',
		'sz' => 'Swaziland',
		'sy' => 'Syrië',
		'tw' => 'Taiwan',
		'tj' => 'Tajikistan',
		'tz' => 'Tanzania',
		'th' => 'Thailand',
		'tg' => 'Togo',
		'tk' => 'Tokelau',
		'to' => 'Tonga',
		'tt' => 'Trinidad and Tobago',
		'cz' => 'Tsjechië',
		'cs' => 'Tsjechoslowakije (Voormalig)',
		'tn' => 'Tunisië',
		'tr' => 'Turkije',
		'tm' => 'Turkmenistan',
		'tc' => 'Turks and Caicos Islands',
		'tv' => 'Tuvalu',
		'um' => 'US Minor Outlying Islands',
		'su' => 'USSR (Voormalig)',
		'ug' => 'Uganda',
		'ua' => 'Ukraine',
		'uy' => 'Uruguay',
		'uz' => 'Uzbekistan',
		'vu' => 'Vanuatu',
		'va' => 'Vaticaanstad',
		've' => 'Venezuela',
		'uk' => 'Verenigd Koninkrijk',
		'ae' => 'Verenigde Arabische Emiraten',
		'us' => 'Verenigde Staten',
		'vn' => 'Viet Nam',
		'wf' => 'Wallis en Futuna Eilanden',
		'eh' => 'West Sahara',
		'ye' => 'Yemen',
		'zr' => 'Zaire',
		'zm' => 'Zambia',
		'zw' => 'Zimbabwe',
		'kr' => 'Zuid Korea',
		'za' => 'Zuid Afrika',
		'se' => 'Zweden',
		'ch' => 'Zwitserland',
	);

	/**
	 * @var array legal forms
	 */
	protected $legalForms = array(
		'ANDERS' => 'Anders',
		'BGG' => 'Buitenlandse EG vennootschap',
		'BRO' => 'Buitenlandse rechtsvorm/onderneming/nevenvestiging',
		'BV' => 'Besloten Vennootschap',
		'BVI/O' => 'B.V. in oprichting',
		'COOP' => 'Cooperatie',
		'CV' => 'Commanditaire Vennootschap',
		'EENMANSZAAK' => 'Eenmanszaak',
		'EESV' => 'Europees Economisch Samenwerkingsverband',
		'KERK' => 'Kerkgenootschap',
		'NV' => 'Naamloze Vennootschap',
		'OWM' => 'Onderlinge Waarborg Maatschappij',
		'REDR' => 'Rederij',
		'STICHTING' => 'Stichting',
		'VERENIGING' => 'Vereniging',
		'VOF' => 'Vennootschap onder firma',
	);

	/**
	 * List contacts and show other possibilities for contacts
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('step', 'contact_list');
		$mdr = t3lib_div::makeInstance('Tx_Mdrmanager_3rdParty_mdrApi');
		$mdr->AddParam('command', 'contact_list');
		$mdr->doTransaction();

		$this->_checkForErrors($mdr);

		$contacts = array();
		for($i=0; $i<$mdr->Values["contactcount"]; $i++){
			$contacts[$i]['id'] = $mdr->Values["contact_id[$i]"];
			$contacts[$i]['bedrijfsnaam'] = $mdr->Values["contact_bedrijfsnaam[$i]"];
			$contacts[$i]['voorletter'] = $mdr->Values["contact_voorletter[$i]"];
			$contacts[$i]['tussenvoegsel'] = $mdr->Values["contact_tussenvoegsel[$i]"];
			$contacts[$i]['achternaam'] = $mdr->Values["contact_achternaam[$i]"];
			$contacts[$i]['straat'] = $mdr->Values["contact_straat[$i]"];
			$contacts[$i]['huisnr'] = $mdr->Values["contact_huisnr[$i]"];
			$contacts[$i]['huisnrtoev'] = $mdr->Values["contact_huisnrtoev[$i]"];
			$contacts[$i]['postcode'] = $mdr->Values["contact_postcode[$i]"];
			$contacts[$i]['plaats'] = $mdr->Values["contact_plaats[$i]"];
			$contacts[$i]['land'] = $mdr->Values["contact_land[$i]"];
			$contacts[$i]['email'] = $mdr->Values["contact_email[$i]"];
			$contacts[$i]['tel'] = $mdr->Values["contact_tel[$i]"];
		}
		$this->view->assign('contacts', $contacts);

		$this->view->assign('legalForms', $this->legalForms);
		$this->view->assign('countries', $this->countries);
	}

	/**
	 * If there are errors with the transaction set errors to view
	 *
	 * @param Tx_Mdrmanager_3rdParty_mdrApi $mdr
	 * @return void
	 */
	protected function _checkForErrors(Tx_Mdrmanager_3rdParty_mdrApi $mdr) {
		if($mdr->Values['errcount'] > 0) {
			for($i = 1; $i <= $mdr->Values['errcount']; $i++) {
				$this->flashMessageContainer->add($mdr->Values[ "errnotxt".$i ] . ' code: ' . $mdr->Values[ "errno".$i ]);
			}
		}
	}

	/**
	 * Show a form to add a new contact
	 */
	public function newContactFormAction() {
		$this->view->assign('step', 'add_contact');
		$this->view->assign('countries', $this->countries);
	}

	/**
	 * Add the contact
	 *
	 * @return void
	 */
	public function addAction() {
		$mdr = t3lib_div::makeInstance('Tx_Mdrmanager_3rdParty_mdrApi');
		$mdr->addParam('command', 'contact_add');
		foreach($this->request->getArguments() as $k => $v) {
			$mdr->addParam($k, $v);
		}
		$mdr->DoTransaction();
		$errors = $this->_checkForErrors($mdr);
		if(empty($errors)) {
			$this->flashMessageContainer->add('contact toegevoegd');
			$this->redirect('index');
		} else {
			$this->flashMessageContainer->add($errors);
			$this->redirect('newContactForm');
		}
	}
}

?>