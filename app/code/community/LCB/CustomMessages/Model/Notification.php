<?php

class LCB_CustomMessages_Model_Notification extends Mage_Core_Model_Abstract
{
    /**
     * Get json encoded additional data as array
     *
     * @return array
     */
    public function getAdditionalData()
    {
        return json_decode((string) $this->getData('additional_data'), true);
    }

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
