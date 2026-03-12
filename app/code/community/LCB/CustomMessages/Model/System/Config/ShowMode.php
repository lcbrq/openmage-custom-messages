<?php

class LCB_CustomMessages_Model_System_Config_ShowMode extends Mage_Core_Model_Config_Data
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $helper = Mage::helper('core');

        return array(
            0 => $helper->__('Always'),
            1 => $helper->__('Once per session'),
        );
    }
}
