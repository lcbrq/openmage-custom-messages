<?php
/**
 * @author Tomasz Gregorczyk <tom@lcbrq.com>
 */
class LCB_CustomMessages_Block_Adminhtml_System_Config_Form_Field_Status extends Mage_Core_Block_Html_Select
{
    /**
     * @param string $value
     * @return Mage_CatalogInventory_Block_Adminhtml_Form_Field_Customergroup
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        foreach (Mage::getModel('adminhtml/system_config_source_yesno')->toArray() as $value => $label) {
            $this->addOption($value, $label);
        }
        return parent::_toHtml();
    }
}
