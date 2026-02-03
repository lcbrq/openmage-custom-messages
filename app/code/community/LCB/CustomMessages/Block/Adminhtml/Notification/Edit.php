<?php

/**
 * @author Tomasz Gregorczyk <tom@lcbrq.com>
 */
class LCB_CustomMessages_Block_Adminhtml_Notification_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Configure edit form container
     */
    public function __construct()
    {
        $this->_objectId   = 'id';
        $this->_blockGroup = 'lcb_custom_messages';
        $this->_controller = 'adminhtml_notification';
        parent::__construct();
        $this->_updateButton('save', 'label', Mage::helper('lcb_custom_messages')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('lcb_custom_messages')->__('Delete'));
    }

    /**
     * Header text getter
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('notification_data') && Mage::registry('notification_data')->getId()) {
            return Mage::helper('lcb_custom_messages')->__(
                "Edit Notification '%s'",
                $this->htmlEscape(Mage::registry('notification_data')->getTitle())
            );
        } else {
            return Mage::helper('lcb_custom_messages')->__('Add Notification');
        }
    }
}
