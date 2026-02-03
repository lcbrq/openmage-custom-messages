<?php

/**
 * @author Tomasz Gregorczyk <t.gregorczyk@gtx-group.com>
 */
class LCB_CustomMessages_Adminhtml_CustomMessages_NotificationsController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @inheritDoc
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('lcb_custom_messages');
    }

    /**
     * Show logs grid
     */
    public function indexAction(): void
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('lcb_custom_messages/adminhtml_notification'));
        $this->renderLayout();
    }

    /**
     * Edit (or new) action
     *
     * @return void
     */
    public function editAction()
    {
        $id    = $this->getRequest()->getParam('id');
        $model = Mage::getModel('lcb_custom_messages/notification')->load($id);

        if ($model || $id == 0) {
            $model->setCustomHandle($model->getHandle());
            if ($model->getStatus() === null) {
                $model->setStatus(true);
            }
            Mage::register('notification_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('cms/notifications');
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('lcb_custom_messages/adminhtml_notification_edit'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Notification does not exist'));
            $this->_redirect('*/*/');
        }
    }

    /**
     * New action forwarder
     *
     * @return void
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Save data
     *
     * @return void
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            if ($data['handle'] === 'custom' && !empty($data['custom_handle'])) {
                $data['handle'] = $data['custom_handle'];
            }
            $model = Mage::getModel('lcb_custom_messages/notification');
            $id = $this->getRequest()->getParam('id');
            $model->setData($data)->setId($id);
            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Notification was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $model->getId()]);
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', ['id' => $id]);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find notification to save'));
        $this->_redirect('*/*/');
    }

    /**
     * Delete action
     *
     * @return void
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id > 0) {
            try {
                Mage::getModel('lcb_custom_messages/notification')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Notification was successfully deleted'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', ['id' => $id]);
            }
        }
        $this->_redirect('*/*/');
    }
}
