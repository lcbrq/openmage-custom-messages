<?php

/**
 * @author Tomasz Gregorczyk <tom@lcbrq.com>
 */
class LCB_CustomMessages_Block_Adminhtml_Notification_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Build form fields
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id'     => 'edit_form',
            'action' => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ]);

        $fieldset = $form->addFieldset('notification_form', ['legend' => $this->__('Details')]);

        $fieldset->addField('status', 'select', array(
            'name' => 'status',
            'label'    => $this->__('Status'),
            'required' => true,
            'class' => 'required-entry',
            'values' => Mage::getSingleton('adminhtml/system_config_source_enabledisable')->toOptionArray(),
        ));

        $fieldset->addField('handle', 'select', [
            'name'     => 'handle',
            'label'    => $this->__('Handle'),
            'required' => true,
            'type' => 'options',
            'options' => Mage::getSingleton('lcb_custom_messages/system_config_handle')->toOptionArray(),
        ]);

        $fieldset->addField('custom_handle', 'text', [
            'name'     => 'custom_handle',
            'label'    => '',
        ]);

        $fieldset->addField('type', 'select', [
            'name'     => 'type',
            'label'    => $this->__('Type'),
            'required' => true,
            'type' => 'options',
            'options' => Mage::getSingleton('lcb_custom_messages/system_config_type')->toOptionArray(),
        ]);

        $fieldset->addField('title', 'text', [
            'name'     => 'title',
            'label'    => $this->__('Title'),
            'required' => true,
        ]);

        $fieldset->addField('message', 'textarea', [
            'name'     => 'message',
            'label'    => $this->__('Notification'),
            'required' => false,
        ]);

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'select', array(
                'name' => 'store_id',
                'label' => $this->__('Store View'),
                'title' => $this->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        } else {
            $fieldset->addField('store_id', 'hidden', array(
                'name' => 'store_id',
                'value' => Mage::app()->getStore(true)->getId(),
            ));
        }

        if (Mage::registry('notification_data')) {
            $form->setValues(Mage::registry('notification_data')->getData());
        }

        $this->setChild(
            'form_after',
            $this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
                ->addFieldMap('handle', 'handle')
                ->addFieldMap('custom_handle', 'custom_handle')
                ->addFieldDependence('custom_handle', 'handle', 'custom')
        );

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
