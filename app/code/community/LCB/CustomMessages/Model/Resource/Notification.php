<?php

class LCB_CustomMessages_Model_Resource_Notification extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('lcb_custom_messages/notification', 'entity_id');
    }
}
