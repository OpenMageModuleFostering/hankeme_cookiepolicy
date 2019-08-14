<?php

/**
 * @package Hankeme_Cookiepolicy
 * @authors Jan Strohmeier [jan.strohmeier@hanke.me]
 * @developers Jan Strohmeier [jan.strohmeier@hanke.me]
 * @web http://www.hankeme.de
 * @version 0.1.0
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0) 
 */

class Hankeme_Cookiepolicy_Block_Layer extends Mage_Core_Block_Template {

	private $local_policies = array(
					'AT' => 'opt_in',
					'CZ' => 'opt_out',
					'DK' => 'opt_in',
					'FR' => 'opt_in',
					'LT' => 'opt_in',
					'NL' => 'opt_in',
					'ES' => 'opt_out',
					'DE' => 'opt_out',
					'SE' => 'opt_in',
					'GB' => 'opt_in',
					'BG' => 'opt_out',
					'FI' => 'opt_out',
					'LU' => 'opt_out',
					'SK' => 'opt_out',
				);

	private $policies = array(
			1 => 'opt_in',
	    		2 => 'opt_out',
	    		3 => 'hint_once',
	    		4 => 'recommended'
			);

	public function getLayer() {

		if(Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_enabled')){

			$policyconfig = Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_policy');

			$policy = $this->policies[$policyconfig];

			if($policy == 'recommended') {
				if($country = Mage::getStoreConfig('general/country/default')) {
				
					if(array_key_exists($country, $this->local_policies)) $policy = $this->local_policies[$country];
					else $policy = 'opt_out';

				}
			}

			if($policy) {

				$hascookie = Mage::getModel('core/cookie')->get('hankeme_cookiepolicy') ? true : false;
				if(!$hascookie) {
					switch($policy) {
						case 'opt_in':

							$msg = Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_text') ? Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_text') : 'This Site uses Cookies to store temporary Information needed for proper Functioning. By clicking the Button below you agree to this fact. More Information is available on our <a href="%s">Cookie Policy Page</a>';

							$button = Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_button_text') ? Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_button_text') : 'I Agree to the use of Cookies';

							return array(
								'message' => $msg,
								'link' => Mage::getStoreConfig('web/default/cms_no_cookies'),
								'ok_button' => $button,
								'type' => 'opt_in'
							);

						break;
						case 'opt_out':

							$msg = Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_text') ? Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_text') : 'This Site uses Cookies to store temporary Information needed for proper Functioning. If you do not agree to this fact you can disable Cookies in your Browser Settings. However, in this Case you will not be able to use this Site. More Information is available on our <a href="%s">Cookie Policy Page</a>';

							$button = Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_button_text') ? Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_button_text') : 'Hide Message';

							return array(
								'message' => $msg,
								'link' => Mage::getStoreConfig('web/default/cms_no_cookies'),
								'ok_button' => $button,
								'type' => 'opt_out'
							);


						break;
						case 'hint_once':
							$msg = Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_text') ? Mage::getStoreConfig('cookiepolicy/basic_group/cookiepolicy_text') : 'This Site uses Cookies to store temporary Information needed for proper Functioning. If you do not agree to this fact you can disable Cookies in your Browser Settings. However, in this Case you will not be able to use this Site. More Information is available on our <a href="%s">Cookie Policy Page</a>';

							//set cookie, layer will only be shown once
							Mage::getModel('core/cookie')->set('hankeme_cookiepolicy', 1);

							return array(
								'message' => $msg,
								'link' => Mage::getStoreConfig('web/default/cms_no_cookies'),
								'ok_button' => false,
								'type' => 'hint_once'
							);
						break;
					}
				}
			}		
		}

		return false;
	}

}
