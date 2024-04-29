<?php
/**
 * @author Tomasz Gregorczyk <tom@lcbrq.com>
 */
class LCB_CustomMessages_Block_Adminhtml_System_Config_Form_Field_Message extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    /**
     * @var LCB_CustomMessages_Block_Adminhtml_System_Config_Form_Field_Status
     */
    protected $_statusRenderer;

    /**
     * @inheritDoc
     */
    protected function _prepareToRender()
    {
        $this->addColumn('handle', array(
            'label' => Mage::helper('adminhtml')->__('Handle'),
            'style' => 'width:160px',
        ));

        $this->addColumn('message', array(
            'label' => Mage::helper('adminhtml')->__('Message'),
            'style' => 'width:600px',
        ));

        $this->addColumn('active', [
            'label' => Mage::helper('adminhtml')->__('Active'),
            'renderer' => $this->_getStatusRenderer(),
        ]);

        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('adminhtml')->__('Add Handle');
    }

    /**
     * Retrieve status column renderer
     *
     * @return LCB_CustomMessages_Block_Adminhtml_System_Config_Form_Field_Status
     */
    protected function _getStatusRenderer()
    {
        if (!$this->_statusRenderer) {
            $this->_statusRenderer = $this->getLayout()->createBlock(
                'lcb_custom_messages/adminhtml_system_config_form_field_status',
                '',
                ['is_render_to_js_template' => true]
            );
            $this->_statusRenderer->setExtraParams('style="width:120px"');
        }
        return $this->_statusRenderer;
    }

    /**
     * Prepare existing row data object
     *
     * @param Varien_Object $row
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getStatusRenderer()->calcOptionHash($row->getData('active')),
            'selected="selected"'
        );
    }
}
