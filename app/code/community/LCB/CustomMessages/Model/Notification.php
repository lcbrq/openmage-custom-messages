<?php

class LCB_CustomMessages_Model_Notification extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('lcb_custom_messages/notification');
    }

    protected function _beforeSave()
    {
        if (!(bool) $this->getData('created_at')) {
            $this->setData('created_at', Varien_Date::now());
        }

        return parent::_beforeSave();
    }
}
