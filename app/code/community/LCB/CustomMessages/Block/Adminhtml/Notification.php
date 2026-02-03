<?php

class LCB_CustomMessages_Block_Adminhtml_Notification extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup      = 'lcb_custom_messages';
        $this->_controller      = 'adminhtml_notification';
        $this->_headerText      = $this->__('Notifications');
        parent::__construct();
    }
}
