<?php

/**
 * @author Tomasz Gregorczyk <tom@lcbrq.com>
 */
class LCB_CustomMessages_Model_Observer
{
    /**
     * @param  Varien_Event_Observer $observer
     * @return void
     */
    public function beforeLoadLayout(Varien_Event_Observer $observer)
    {
        Mage::getModel('lcb_custom_messages/system_config_handle');
        if ($layout = $observer->getLayout()) {
            $update = $layout->getUpdate();
            $messageHandles = Mage::helper('lcb_custom_messages')->getHandles();
            if ($update && $messageHandles && ($layoutHandles = $update->getHandles())) {
                foreach ($layoutHandles as $layoutHandle) {
                    if (!empty($messageHandles[$layoutHandle])) {
                        foreach ($messageHandles[$layoutHandle] as $notification) {
                            $message = $notification['message'];
                            switch ($notification['type']) {
                                case 'warning':
                                    Mage::getSingleton('core/session')->addWarning($message);
                                    break;
                                case 'success':
                                    Mage::getSingleton('core/session')->addSuccess($message);
                                    break;
                                default:
                                    Mage::getSingleton('core/session')->addNotice($message);
                                    break;
                            }
                        }
                    }
                }
                $update->addHandle('lcb_custom_message');
            }
        }
    }
}
