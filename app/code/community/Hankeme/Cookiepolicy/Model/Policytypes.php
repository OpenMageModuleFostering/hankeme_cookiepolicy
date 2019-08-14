<?php
/**
 * @package Hankeme_Cookiepolicy
 * @authors Jan Strohmeier [jan.strohmeier@hanke.me]
 * @developers Jan Strohmeier [jan.strohmeier@hanke.me]
 * @web http://www.hankeme.de
 * @version 0.1.0
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0) 
 */

class Hankeme_Cookiepolicy_Model_Policytypes
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label'=>Mage::helper('hankeme_cookiepolicy')->__('Opt-In')),
            array('value' => 2, 'label'=>Mage::helper('hankeme_cookiepolicy')->__('Opt-Out')),
            array('value' => 3, 'label'=>Mage::helper('hankeme_cookiepolicy')->__('Hint Once')),
            array('value' => 4, 'label'=>Mage::helper('hankeme_cookiepolicy')->__('Recommended')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            1 => Mage::helper('hankeme_cookiepolicy')->__('Opt-In'),
	    2 => Mage::helper('hankeme_cookiepolicy')->__('Opt-Out'),
	    3 => Mage::helper('hankeme_cookiepolicy')->__('Hint Once'),
	    4 => Mage::helper('hankeme_cookiepolicy')->__('Recommended')
        );
    }

}
