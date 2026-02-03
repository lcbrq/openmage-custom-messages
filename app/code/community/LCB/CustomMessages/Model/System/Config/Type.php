<?php

class LCB_CustomMessages_Model_System_Config_Type extends Mage_Core_Model_Config_Data
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $helper = Mage::helper('core');

        return array(
            'notice' => $helper->__('Notice'),
            'warning' => $helper->__('Warning'),
            'success' => $helper->__('Success'),
        );
    }
}
