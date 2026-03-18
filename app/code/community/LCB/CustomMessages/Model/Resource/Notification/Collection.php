<?php

class LCB_CustomMessages_Model_Resource_Notification_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * @inheritDoc
     */
    protected $_eventPrefix = 'lcb_custom_messages_notifications';

    /**
     * @inheritDoc
     */
    protected $_eventObject = 'collection';

    protected function _construct()
    {
        $this->_init('lcb_custom_messages/notification');
    }
}
